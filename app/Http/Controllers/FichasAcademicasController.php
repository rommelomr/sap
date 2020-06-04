<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;
use App\TipoContrato;
use App\Asesor;
use DateTime;
use App\Carrera;
use App\Cliente;
use Illuminate\Validation\Rule;
use App\Contrato;
use App\Cotizacion;
use App\Etapa;
use App\Facultad;
use App\FichaAcademica;
use App\FichaEconomica;
use App\Curso;
use App\Medio;
use App\Modalidad;
use App\NivelAcademico;
use App\ObservacionFicha;
use App\Persona;
use App\Profesion;
use App\User;
use App\Universidad;

class FichasAcademicasController extends Controller
{
    private function consultarFichas($user){

        if($user->id_nivel === 1){
            $fichas = FichaAcademica::with('cotizacion')->paginate(10);

        }else{
            $fichas = FichaAcademica::where('id_asesor',$user->asesor->id)->with('cotizacion')->paginate(10);

        }
        return $fichas;
    }
    public function index(){

        session()->flash('index',true);
        $user = User::with('asesor')->find(Auth::user()->id);
        $fichas = $this->consultarFichas($user);

        $observaciones = [];

    	return view('fichas.fichas_academicas',[
            'fichas'=>$fichas,
            'observaciones'=>$observaciones
        ]);
    }

    public function editarFicha(Request $request){

        session()->flash('editar_ficha',true);
        $msg = [
            'edit_id.required'=>'Ha ocurrido un error inesperado',
            'edit_fecha_inicio.date'=>'La fecha inicial no es válida',
            'edit_fecha_inicio.after'=>'La fecha inicial debe ser como mínimo el dia de hoy',
            'edit_fecha_fin.date'=>'La fecha final no es válida',
            'edit_fecha_fin.after'=>'La fecha final no debe ser la misma que la de inicio',
            'edit_id_etapa.exists'=>'La etapa no es válida'
        ];

        $request->validate([
            'edit_id'=>'required|exists:fichas_academicas,id',
            'edit_fecha_inicio'=>'date|after:'.date('Y-m-d',strtotime('yesterday')),
            'edit_fecha_fin'=>['date','different:edit_fecha_inicio','after:'.date('Y-m-d',strtotime('today')),Rule::requiredIf(function()use($request){
                    return $request->edit_fecha_inicio != null;
            })],
            'edit_id_etapa'=>'exists:etapas,id',
        ]);
        session()->forget('editar_ficha');

        $ficha = FichaAcademica::find($request->edit_id);

        $ficha->fecha_inicio = $request->edit_fecha_inicio;

        $ficha->fecha_fin = $request->edit_fecha_fin;

        $date_one = new DateTime($request->edit_fecha_inicio);
        $date_two = new DateTime($request->edit_fecha_fin);
        $plazo = $date_one->diff($date_two);

        $ficha->plazo = $plazo->days;

        $ficha->id_etapa = $request->edit_id_etapa;
        $ficha->save();
        return redirect()->back()->with(['message'=>[
            'Datos de ficha académica actualizados'
        ]]);
    }
    public function agregarObservacion(Request $request){
        $messages = [];
        $request->validate([
            'id_ficha' => ['required','exists:fichas_academicas,id'],
            'observacion' => ['required']
        ],$messages);
        ObservacionFicha::create([
            'id_ficha'  => $request->id_ficha,
            'observacion'  => $request->observacion,
        ]);
        return redirect()->back()->with([
            'messages'  => ['Observación agregada'],
            'observacion_agregada'  => true,
        ]);
    }
    public function verFicha($id){

    	$ficha = FichaAcademica::with(['cliente'=>function($query){

    		$query->with('persona');

    	},'asesor'=>function($query){

    		$query->with(['usuario'=>function($query){
    			$query->with('persona');
    		}]);

    	},'contrato','cotizacion'=>function($query){

            $query->with([
                'nivelAcademico',
                'tipoCotizacion',
                'medio',
                'modalidad',
                'fichaEconomica',
                'cotizacionBasica',
                'cotizacionUniversitaria'=>function($query){
                    $query->with([
                        'cotizacionGeneral',
                        'cotizacionPosgrado',
                    ]);
                },
            ]);

        },'etapa'])->find($id);

        $user = User::with('asesor')->find(Auth::user()->id);
        //$auth = Auth::user();

        if($user->id_nivel !== 1){
            if($ficha->id_asesor !== $user->asesor->id){
                return redirect()->route('fichas_academicas')->with(['messages'=>['Usted no tiene acceso a esta ficha']]);
            }
        }
        $asesores = Asesor::with(['usuario'=>function($query){
            $query->with('persona');
        }])->get();
        $observaciones = ObservacionFicha::where('id_ficha',$id)->paginate(10);
        $etapas = Etapa::all();

        $fichas = $this->consultarFichas($user);

        $tipos_contrato = TipoContrato::all();
        

    	return view('fichas.fichas_academicas',[
    		'ficha' => $ficha,
            'fichas' => $fichas,
            'etapas' => $etapas,
            'observaciones' => $observaciones,
            'asesores' => $asesores,
            'tipos_contrato' => $tipos_contrato,
            'id_nivel_usuario' => $user->id_nivel,
    	]);
    

    }
    public function crearFicha(Request $request){
    	$messages = [];
    	$request->validate([
    		'id_cotizacion'	=> ['exists:cotizaciones,id','required']
    	],$messages);

    	$cotizacion = Cotizacion::find($request->id_cotizacion);

    	$ficha = FichaAcademica::create([
    		'id_cotizacion'=>$cotizacion->id,
    		'id_cliente'=>$cotizacion->id_cliente
    	]);
        $ficha_economica = FichaEconomica::create([
            'id_cotizacion'=>$cotizacion->id,
        ]);
        
    	return redirect()->route('ver_ficha',['id'=>$ficha->id]);
    }
    public function exportPdffichaA($id)
    {
        $ficha = FichaAcademica::with(['cliente'=>function($query){
            $query->with('persona');
        },'asesor'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            }]);
        },'contrato','cotizacion'=>function($query){
            $query->with('fichaEconomica');
        }   ,'etapa'])->find($id);
        $auth = Auth::user();
        if($auth->id_nivel != 1){
            if($ficha->id_asesor != $auth->asesor->id){
                return redirect()->route('fichas_academicas')->with(['messages'=>['Usted no tiene acceso a esta ficha']]);
            }
        }

        $asesores = Asesor::with(['usuario'=>function($query){
            $query->with('persona');
        }])->get();
        $observaciones = ObservacionFicha::where('id_ficha',$id)->paginate(10);
        $etapas = Etapa::all();

        $user = User::with('asesor')->find(Auth::user()->id);
        if($user->id_nivel == 1){
            $fichas = FichaAcademica::with('cotizacion')->paginate(10);

        }else{
            $fichas = FichaAcademica::where('id_asesor',$user->asesor->id)->with('cotizacion')->paginate(10);

        }
        $tipos_contrato = TipoContrato::all();

        $pdf = PDF::loadView('pdf.fichas_academicas',[
            'ficha' => $ficha,
            'fichas' => $fichas,
            'etapas' => $etapas,
            'observaciones' => $observaciones,
            'asesores' => $asesores,
            'tipos_contrato' => $tipos_contrato,
            'id_nivel_usuario' => $user->id_nivel,
        ]);
        
        return $pdf->setPaper('a4')->stream();

    }
}