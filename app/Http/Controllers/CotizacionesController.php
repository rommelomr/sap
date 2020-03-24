<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\CotizacionGeneral;
use App\CotizacionPosgrado;
use App\Persona;
use App\Cliente;
use App\Carrera;
use App\Universidad;
use App\Facultad;
use App\Curso;
use App\Modalidad;
use App\Medio;
use App\NivelAcademico;
use App\Profesion;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade as PDF;

class CotizacionesController extends Controller
{
    public static function sphinx_sapcoti(Request $request)
    {
        $cotizaciones     = new Cotizacion;
        $busqueda       = $request->all();
        $resultadosBusqueda = $cotizaciones->busqueda($busqueda['buscar']);
        $niveles = NivelAcademico::all();
        $universidades = Universidad::all();
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        $profesiones = Profesion::all();
        $grados = Grado::all();
        $modalidades = Modalidad::all();
        $medios = Medio::all();


        //dd($resultBusqueda);
        
        return view('cotizaciones', compact('resultadosBusqueda','niveles','universidades','facultades','carreras','profesiones','grados','modalidades','medios'));
    }

/*
    Head
*/
    public static function buscarCotizacion($id){

        $cotizaciones = Cotizacion::with(['cliente'=>function($query){
            $query->with('persona');
        },'universidad','nivelAcademico','cotizacionGeneral'=>function($query){
            $query->with(['carrera','facultad']);
        },'cotizacionPosgrado','grado','modalidad','curso','medio','ficha'])->where('id',$id)->paginate(10);
        session()->flash('tab',2);

        $cotizacion = Cotizacion::with(['cliente','universidad','nivelAcademico','cotizacionGeneral'=>function($query){
            $query->with(['facultad','carrera',]);
        },'cotizacionPosgrado','grado','modalidad','medio'])->find($id);
        session()->flash('edit_id_cotizacion',$cotizacion->id);
        session()->flash('edit_nombre',$cotizacion->cliente->persona->nombre);
        session()->flash('edit_direccion',$cotizacion->cliente->persona->direccion);
        session()->flash('edit_celular',$cotizacion->cliente->persona->celular);
        session()->flash('edit_telefono',$cotizacion->cliente->persona->telefono);
        session()->flash('edit_precio',$cotizacion->precio_total);
        
        session()->flash('edit_nivel',$cotizacion->id_nivel_academico != null ? $cotizacion->id_nivel_academico : null);
        session()->flash('edit_universidad',$cotizacion->universidad != null ? $cotizacion->universidad->id : null);
        session()->flash('edit_facultad',$cotizacion->cotizacionGeneral != null ? $cotizacion->cotizacionGeneral->id_facultad : null);
        session()->flash('edit_carrera',$cotizacion->cotizacionGeneral != null ? $cotizacion->cotizacionGeneral->id_carrera : null);
        session()->flash('edit_profesion',$cotizacion->id_profesion != null ? $cotizacion->id_profesion : null);
        session()->flash('edit_curso',$cotizacion->id_curso != null ? $cotizacion->id_curso : null);
        session()->flash('edit_modalidad',$cotizacion->modalidad != null ? $cotizacion->modalidad->id : null);
        session()->flash('edit_validez',$cotizacion->validez != null ? $cotizacion->validez : null);
        session()->flash('edit_tema',$cotizacion->tema != null ? $cotizacion->tema : null);
        session()->flash('edit_observacion',$cotizacion->observaciones != null ? $cotizacion->observaciones : null);
        session()->flash('edit_avance',$cotizacion->avance != null ? $cotizacion->avance : null);
        session()->flash('edit_medio',$cotizacion->medio != null ? $cotizacion->medio->id : null);
        $niveles = NivelAcademico::all();
        $universidades = Universidad::all();
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        $profesiones = Profesion::all();
        $cursos = Curso::all();
        $modalidades = Modalidad::all();
        $medios = Medio::all();

        //dd($cotizacion);
        return view('cotizaciones',compact('cotizacion','cotizaciones','niveles','universidades','facultades','carreras','profesiones','cursos','modalidades','medios'));
    }

    public static function validarPermisosModificacion($cotizacion,$request){
        $auth = Auth::user();
        return !($auth->id_nivel !== 1) && ($cotizacion->precio_total !== $request->edit_precio || $cotizacion->id_medio !== $request->edit_medio);
    }
    public static function modificarCotizacion(Request $request){
        session()->flash('tab',2);
        $request->validate([
            'edit_id_cotizacion'=> ['required','exists:cotizaciones,id','numeric'],
            'edit_precio'    => ['required','numeric'],
            'edit_nivel'    => ['exists:niveles_academicos,id','nullable'],
            'edit_universidad'    => ['exists:universidades,id','nullable'],
            'edit_facultad'    => ['exists:facultades,id','nullable',Rule::requiredIf(function()use($request){
                return $request->edit_nivel <= 5;
            })],
            'edit_carrera'    => ['exists:carreras,id','nullable',Rule::requiredIf(function()use($request){
                return $request->edit_nivel <= 5;
            })],
            'edit_profesion'    => ['exists:profesiones,id','nullable'],
            'edit_curso'    => ['exists:cursos,id','nullable'],
            'edit_avance'    => ['numeric','nullable'],
            'edit_validez'    => ['numeric','nullable'],
            'edit_modalidad'    => ['exists:modalidades,id','nullable'],
            'edit_medio'    => ['exists:medios,id','nullable'],
            'edit_tema'    => ['max:65535','nullable'],
            'edit_observacion'    => ['max:65535','nullable'],
        ]);
        session()->forget('tab');
        $cotizacion = Cotizacion::find($request->edit_id_cotizacion);

        $validation_success = CotizacionesController::validarPermisosModificacion($cotizacion,$request);

        if(!$validation_success){
            return redirect()->back()->with(['messages'=>['No tiene permisos para realizar esta acción']]);
        }

        $cotizacion->precio_total = $request->edit_precio; 
        $cotizacion->id_nivel_academico = $request->edit_nivel; 
        $cotizacion->id_universidad = $request->edit_universidad;
        if($cotizacion->cotizacionPosgrado == null){
            if($request->edit_nivel < 6){
                $cotizacion->cotizacionGeneral->id_facultad = $request->edit_facultad; 
                $cotizacion->cotizacionGeneral->id_carrera = $request->edit_carrera; 
                $facultad_back = $request->edit_facultad;
                $carrera_back = $request->edit_carrera;
            }else{
                $cotizacion_general = CotizacionGeneral::where('id_cotizacion',$cotizacion->id)->first();
                $cotizacion_general->delete();

                $facultad_back = "";
                $carrera_back = "";

                CotizacionPosgrado::create([
                    'id_cotizacion'=>$cotizacion->id,
                ]);
            }
        }else{
            if($request->edit_nivel < 6){
                $cotizacion_posgrado = CotizacionPosgrado::where('id_cotizacion',$cotizacion->id)->first();
                $cotizacion_posgrado->delete();
                CotizacionGeneral::create([
                    'id_cotizacion'=>$cotizacion->id,
                    'id_facultad'=>$request->edit_facultad,
                    'id_carrera'=>$request->edit_carrera,
                ]);
                $facultad_back = $request->edit_facultad;
                $carrera_back = $request->edit_carrera;
            }else{
                $facultad_back = "";
                $carrera_back = "";
            }
        }
        $cotizacion->id_profesion = $request->edit_profesion; 
        $cotizacion->id_curso = $request->edit_curso; 
        $cotizacion->id_modalidad = $request->edit_modalidad; 
        $cotizacion->id_medio = $request->edit_medio; 
        $cotizacion->avance = $request->edit_avance; 
        $cotizacion->validez = $request->edit_validez; 
        $cotizacion->tema = $request->edit_tema; 
        $cotizacion->observaciones = $request->edit_observacion;
        $cotizacion->push();

        return redirect()->back()->with([
            'edit_nombre' => $request->edit_nombre,
            'edit_direccion' => $request->edit_direccion,
            'edit_telefono' => $request->edit_telefono,
            'edit_celular' => $request->edit_celular,
            'edit_id_cotizacion' => $cotizacion->id,
            'edit_precio' =>$cotizacion->precio_total, 
            'edit_nivel' =>$cotizacion->id_nivel_academico, 
            'edit_universidad' =>$cotizacion->id_universidad, 
            'edit_facultad' =>$facultad_back, 
            'edit_carrera' =>$carrera_back, 
            'edit_profesion' =>$cotizacion->id_profesion, 
            'edit_curso' =>$cotizacion->id_curso, 
            'edit_avance' =>$cotizacion->avance, 
            'edit_validez' =>$cotizacion->validez, 
            'edit_modalidad' =>$cotizacion->id_modalidad, 
            'edit_medio' =>$cotizacion->id_medio, 
            'edit_tema' =>$cotizacion->tema, 
            'edit_observacion' =>$cotizacion->observaciones, 
            'tab' =>2,
            'messages' =>[
                'Cotizacion actualizada'
            ],
        ]);
    }
    public static function buscarCotizaciones(Request $request){

        $string = $request->buscar;

/*
        $niveles = NivelAcademico::where('nombre','like','%'.$string.'%')->first();
        $universidades = Universidad::where('nombre','like','%'.$string.'%')->first();
        //$facultades = Facultad::where('nombre','like','%'.$string.'%')->first();
        $carreras = Carrera::where('nombre','like','%'.$string.'%')->first();
        $profesiones = Profesion::where('nombre','like','%'.$string.'%')->first();
        $grados = Grado::where('nombre','like','%'.$string.'%')->first();
        $modalidades = Modalidad::where('nombre','like','%'.$string.'%')->first();
        $medios = Medio::where('nombre','like','%'.$string.'%')->first();
*/
            $auth = Auth::user();
        $cotizaciones = Cotizacion::where(function($query)use($string){
            $query->where('id','like','%'.$string.'%')
            ->orWhere('created_at','like','%'.$string.'%')
            ->orWhereHas('cliente',function($query)use($string){
                        $query->where('carnet','like','%'.$string.'%')->orWhereHas('persona',function($query) use ($string){
                            $query->where('cedula','like','%'.$string.'%');
                        });
                    })
            ->orWhereHas('universidad',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');
                })
            ->orWhereHas('nivelAcademico',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');
                })
            ->orWhereHas('cotizacionGeneral',function($query) use ($string){
                    $query->orWhereHas('carrera',function($query)use($string){
                        $query->where('nombre','like','%'.$string.'%');
                    })->orWhereHas('facultad',function($query)use($string){
                        $query->where('nombre','like','%'.$string.'%');
                    });
                })
            ->orWhereHas('curso',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');
                })
            ->orWhereHas('modalidad',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');
                })
            ->orWhereHas('medio',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');
                })
            ->with(['cliente'=>function($query){
                $query->with('persona');
        },'universidad','nivelAcademico','cotizacionGeneral'=>function($query){
            $query->with(['carrera','facultad']);
        },'modalidad','medio','curso','ficha'])->paginate(10);
        })->whereHas('ficha',function($query)use($auth){
            $query->where('id_asesor',$auth->asesor->id);
        })->paginate(10);
/*
        if($auth->id_nivel===1){
            $cotizaciones = $cotizaciones->paginate(10);
        }else{
            $cotizaciones = $cotizaciones->whereHas('ficha',function($query)use($auth){
                $query->where('id_asesor',$auth->asesor->id);
            })->paginate(10);
        }
*/
        $niveles = NivelAcademico::all();
        $universidades = Universidad::all();
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        $cursos = Curso::all();
        $profesiones = Profesion::all();
        $modalidades = Modalidad::all();
        $medios = Medio::all();
        return view('cotizaciones',[
            'cotizaciones' => $cotizaciones,
            'niveles' => $niveles,
            'universidades' => $universidades,
            'facultades' => $facultades,
            'carreras' => $carreras,
            'profesiones' => $profesiones,
            'cursos' => $cursos,
            'modalidades' => $modalidades,
            'medios' => $medios
        ]);

    }
    public function cotisapp(Request $request){
        $cotizaciones = Cotizacion::find($request->id_cliente);
            if (!is_null($cotizaciones)) {
            $cotizaciones->id = $request->id;
            $cotizaciones->created_at = $request->created_at;
            $cotizaciones->precio_total = $request->precio_total;
            $cotizaciones->save();

                if ($request->id_cliente!=''){
                    $clientes = Cliente::where('id',$cotizaciones->id_cliente)->first();
                    $clientes->carnet = $request->cu;
                    $clientes->save();
                }
                if($request->id_persona!=''){
                    $personas = Persona::where('id',$clientes->id_persona)->first();
                    $personas->nombre = $request->nombre;
                    $personas->apellido = $request->apellido;
                    $personas->cedula = $request->cedula;
                    $personas->save();
                }
                if ($request->id_carrera!=''){
                    $carreras = Carrera::where('id',$cotizaciones->id_carrera)->first();
                    $carreras->nombre = $request->nombre;
                    $carreras->save();
                }
            }
        return view('cotizaciones', compact('cotizaciones','clientes','personas','carreras'));

        }
    public function index(){
        $cotizaciones = Cotizacion::with(['cliente'=>function($query){
            $query->with('persona');
        },'universidad','nivelAcademico','cotizacionGeneral'=>function($query){
            $query->with(['carrera','facultad']);
        },'cotizacionPosgrado','modalidad','curso','medio','ficha'])->orderBy('created_at','DESC'); 
        $auth = Auth::user();
        if($auth->id_nivel === 1){
            $cotizaciones = $cotizaciones->paginate(10);
        }else{
            $cotizaciones = $cotizaciones->whereHas('ficha',function($query) use ($auth){
                $query->where('id_asesor',$auth->asesor->id);
            })->paginate(10);

        }

        $niveles = NivelAcademico::all();
        $universidades = Universidad::all();
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        $profesiones = Profesion::all();
        $cursos = Curso::all();
        $modalidades = Modalidad::all();
        $medios = Medio::all();
        
        /*
        $resultBusqueda = [
            'codigo' => 200,
            'datos' => $resultBusqueda->all(),
            'mensaje' => null,
        ];
        */
        return view('cotizaciones', compact('cotizaciones','niveles','cursos','universidades','facultades','carreras','profesiones','modalidades','medios'));
    }

    public static function sphinx_sapcotid(Request $request)
    {
        $cotizaciones   = new Cotizacion;
        $busquedacl       = $request->all();
        $resultBusqueda = $cotizaciones->busquedacl($busquedacl['buscarcoti']);
        dd ($resultBusqueda);
        return view('cotizaciones', compact('resultBusqueda'));
    }
    public function buscar_cotizacion(Request $request)
    {
        $cotizacion = Persona::name($request->get('nombre'))->orderBy('id','DESC')->paginate();
            return redirect()->route('cotizaciones', [$id]);
    }
    
    public function guardarCotizacion(Request $request){

        $request->validate([
            'id_cliente'=> ['required','exists:clientes,id','numeric'],
            'precio'    => ['required','numeric'],
            'direccion'    => ['required'],
            'celular'    => ['required'],
            'telefono'    => ['required'],
            'nivel'    => ['bail','required','exists:niveles_academicos,id'],
            'universidad'    => ['exists:universidades,id','nullable'],
            'facultad'    => ['exists:facultades,id','nullable'],
            'carrera'    => ['exists:carreras,id','nullable'],
            'profesion'    => ['exists:profesiones,id','nullable'],
            'curso'    => ['exists:cursos,id','nullable'],
            'modalidad'    => ['exists:modalidades,id','required'],
            'medio'    => ['exists:medios,id','nullable'],
            'tema'    => ['max:65535','nullable'],
            'observacion'    => ['max:65535','nullable'],
        ]);
        $cotizacion = Cotizacion::create([
            'id_cliente'=>$request->id_cliente,
            'id_universidad'=>$request->universidad,
            'id_nivel_academico'=>$request->nivel,
            'id_curso'=>$request->curso,
            'id_modalidad'=>$request->modalidad,
            'id_medio'=>$request->medio,
            'tema'=>$request->tema,
            'avance'=>$request->avance,
            'observaciones'=>$request->observacion,
            'precio_total'=>$request->precio,
            'validez'=>$request->validez,
        ]);
        if($request->nivel < 6){
            CotizacionGeneral::create([
               'id_cotizacion' =>$cotizacion->id,
                'id_facultad'=>$request->facultad,
                'id_carrera'=>$request->carrera
            ]);
        }else{
            CotizacionPosgrado::create([
               'id_cotizacion' => $cotizacion->id
            ]);
        }
        return redirect()->back()->with([
            'messages'=>[
                'Cotización creada correctamente'
            ],
            'tab' => 1


        ]);
    }
    public function exportPdf($id)
    {
        $cotizacion = Cotizacion::where('id','=',$id)->firstorFail();
        //$cotizaciones = Cotizacion::find($id);
        $nivel = NivelAcademico::where('id','=',$id)->firstorFail();
        $universidad = Universidad::where('id','=',$id)->firstorFail();
        $facultad = Facultad::where('id','=',$id)->firstorFail();
        $carrera = Carrera::where('id','=',$id)->firstorFail();
        $profesion = Profesion::where('id','=',$id)->firstorFail();
        $grado = Grado::where('id','=',$id)->firstorFail();
        $modalidad = Modalidad::where('id','=',$id)->firstorFail();
        $medio = Medio::where('id','=',$id)->firstorFail();
        $pdf = PDF::loadView('pdf.cotizaciones', compact('cotizacion','nivel','universidad','facultad','carrera','profesion','grado','modalidad','medio'));
        return $pdf->download('cotizacion-list.pdf');

    }
}