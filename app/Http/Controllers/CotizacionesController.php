<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\CotizacionBasica;
use App\CotizacionUniversitaria;
use App\CotizacionGeneral;
use App\CotizacionPosgrado;
use App\Persona;
use App\Cliente;
use App\Carrera;
use App\Universidad;
use App\Facultad;
use App\TipoCotizacion;
use App\Posgrado;
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


    public static function modificarCotizacion(Request $request){
        session()->flash('tab',2);
        Cotizacion::validateModify($request,Rule::class);
        session()->forget('tab');
        $cotizacion = Cotizacion::find($request->edit_id_cotizacion);
/*
          "edit_id_cotizacion" => "50"
          "edit_nivel" => "2"


          "edit_tipo_cotizacion" => "2"
          "edit_universidad" => null
          "edit_carreras" => null
          "edit_profesion" => null
          "edit_modalidades" => "1"
          "edit_curso" => "5"
          "edit_paralelo" => "A"
          "edit_posgrado" => null
          "edit_validez" => "12"
          "edit_precio" => "12"
          "edit_tema" => "asfd12"
          "edit_observacion" => "asfd12"
          "edit_avance" => "10"
          "edit_medio" => "1"
*/        
        if($cotizacion->id_tipo_cotizacion != $request->edit_tipo_cotizacion){
            $cotizacion->id_tipo_cotizacion = $request->edit_tipo_cotizacion;
        }

        if($cotizacion->curso != $request->edit_curso){
            $cotizacion->curso = $request->edit_curso;
        }

        if($cotizacion->paralelo != $request->edit_paralelo){
            $cotizacion->paralelo = $request->edit_paralelo;
        }

        if($cotizacion->id_medio != $request->edit_medio){
            $cotizacion->id_medio = $request->edit_medio;
        }

        if($cotizacion->id_modalidad != $request->edit_modalidades){
            $cotizacion->id_modalidad = $request->edit_modalidades;
        }
        
        if($cotizacion->tema != $request->edit_tema){
            $cotizacion->tema = $request->edit_tema;
        }

        if($cotizacion->avance != $request->edit_avance){
            $cotizacion->avance = $request->edit_avance;
        }

        if($cotizacion->observaciones != $request->edit_observacion){
            $cotizacion->observaciones = $request->edit_observacion;
        }

        if($cotizacion->validez != $request->edit_validez){
            $cotizacion->validez = $request->edit_validez;
        }

        if($cotizacion->id_nivel_academico > 2){

            $universidad = Universidad::firstOrCreate(['nombre'=>$request->edit_universidad]);

            if($cotizacion->cotizacionUniversitaria->id_universidad != $universidad->id){

                $cotizacion->cotizacionUniversitaria->id_universidad = $universidad->id;
            }


            $profesion = Profesion::firstOrCreate(['nombre'=>$request->edit_profesion]);

            if($cotizacion->cotizacionUniversitaria->id_profesion != $profesion->id){

                $cotizacion->cotizacionUniversitaria->id_profesion = $profesion->id;
            }


            if($cotizacion->id_nivel_academico < 5){

                if($cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_facultad != $request->edit_facultades){

                    $cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_facultad = $request->edit_facultades;
                }

                $carrera = Carrera::where('nombre',$request->edit_carreras)->firstOr(function()use($request){
                    Carrera::create([
                        'nombre' => $request->edit_carreras,
                        'id_facultad' => $request->edit_carreras,
                    ]);
                });

                if($cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_carrera != $carrera->id){

                    $cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_carrera = $carrera->id;
                }
                
                
            }else if($cotizacion->id_nivel_academico < 9){
                $posgrado = Posgrado::firstOrCreate([
                    'nombre' => $request->edit_posgrado
                ]);
                if($cotizacion->cotizacionUniversitaria->cotizacionPosgrado->id_posgrado != $posgrado->id){

                    $cotizacion->cotizacionUniversitaria->cotizacionPosgrado->id_posgrado = $posgrado->id;
                }
                


            }
        }

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
            'edit_tipo_cotizacion' =>$cotizacion->id_tipo_cotizacion, 
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

                $query->where('carnet','like','%'.$string.'%')

                ->orWhereHas('persona',function($query) use ($string){

                    $query->where('cedula','like','%'.$string.'%')
                    ->orWhere('nombre','like','%'.$string.'%')
                    ->orWhere('email','like','%'.$string.'%')
                    ->orWhere('celular','like','%'.$string.'%')
                    ->orWhere('direccion','like','%'.$string.'%')
                    ->orWhere('apellido','like','%'.$string.'%');
                });
            })
            ->orWhereHas('nivelAcademico',function($query) use ($string){

                  $query->where('nombre','like','%'.$string.'%');
            })
            ->orWhereHas('cotizacionUniversitaria',function($query) use ($string){

                $query->whereHas('universidad',function($query) use ($string){
                    $query->where('nombre','like','%'.$string.'%');

                })
                ->orWhereHas('cotizacionGeneral',function($query)use($string){

                    $query->whereHas('carrera',function($query)use($string){
                        $query->where('nombre','like','%'.$string.'%');

                    })->orWhereHas('facultad',function($query)use($string){

                        $query->where('nombre','like','%'.$string.'%');
                    });
                })
                ->orWhereHas('cotizacionPosgrado',function($query)use($string){
                    $query->whereHas('posgrado',function($query)use($string){
                        $query->where('nombre','like','%'.$string.'%');
                    });
                });
            })
            ->orWhereHas('tipoCotizacion',function($query) use ($string){

                $query->where('nombre','like','%'.$string.'%');
            })
            ->orWhereHas('modalidad',function($query) use ($string){

                $query->where('nombre','like','%'.$string.'%');
            })
            ->orWhereHas('medio',function($query) use ($string){

                $query->where('nombre','like','%'.$string.'%');
            });
        })
        ->with([
            'cliente'=>function($query){

                $query->with('persona');

            },'nivelAcademico'
            ,'modalidad'
            ,'medio'
            ,'tipoCotizacion'
            ,'ficha'
            ,'cotizacionUniversitaria'=>function($query){
                $query->with([
                    'cotizacionGeneral',
                    'cotizacionPosgrado',
                ]);
            }
        ])->paginate(10);
        
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
        $tipos_cotizacion = TipoCotizacion::all();
        $profesiones = Profesion::all();
        $modalidades = Modalidad::all();
        $posgrados = Posgrado::all();
        $medios = Medio::all();

        return view('cotizaciones',[
            'cotizaciones' => $cotizaciones,
            'niveles' => $niveles,
            'universidades' => $universidades,
            'facultades' => $facultades,
            'carreras' => $carreras,
            'profesiones' => $profesiones,
            'tipos_cotizacion' => $tipos_cotizacion,
            'modalidades' => $modalidades,
            'posgrados' => $posgrados,
            'medios' => $medios
        ]);

    }
    public function filtrarCarreras(){
        $id_facultad = $_GET['id'];

        $carreras = Carrera::where('id_facultad',$id_facultad)->get();
        echo json_encode($carreras);
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

        $cotizaciones = Cotizacion::with([
        'cliente'=>function($query){
            $query->with('persona');
        }
        ,'nivelAcademico'
        ,'tipoCotizacion'
        ,'medio'
        ,'cotizacionBasica'
        ,'modalidad'
        ,'cotizacionUniversitaria'=>function($query){
            $query->with([
                'cotizacionGeneral'=>function($query){
                    $query->with(['carrera','facultad']);
                }
                ,'cotizacionPosgrado'=>function($query){
                    $query->with('posgrado');
                }
                ,'profesion'
                ,'universidad'
            ]);
        }
        ,'ficha'])->orderBy('created_at','DESC'); 
        
        $auth = Auth::user();
        if($auth->id_nivel == 1){
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
        $tipos_cotizacion = TipoCotizacion::all();
        $modalidades = Modalidad::all();
        $medios = Medio::all();
        $posgrados = Posgrado::all();
        
        /*
        $resultBusqueda = [
            'codigo' => 200,
            'datos' => $resultBusqueda->all(),
            'mensaje' => null,
        ];
        */

        return view('cotizaciones', compact('cotizaciones','niveles','tipos_cotizacion','universidades','facultades','carreras','profesiones','modalidades','medios','posgrados'));
    }

    public static function sphinx_sapcotid(Request $request)
    {
        $cotizaciones   = new Cotizacion;
        $busquedacl       = $request->all();
        $resultBusqueda = $cotizaciones->busquedacl($busquedacl['buscarcoti']);
        
        return view('cotizaciones', compact('resultBusqueda'));
    }
    public function buscar_cotizacion(Request $request)
    {
        $cotizacion = Persona::name($request->get('nombre'))->orderBy('id','DESC')->paginate();
            return redirect()->route('cotizaciones', [$id]);
    }
    
    public function firstOrCreate($input,$Class){
        if($input!=null){

            return $Class::firstOrCreate(['nombre'=>$input]);
        }else{
            return null;
        }
    }
    private function parseInt($arr){
        foreach ($arr as $key => $value) {
            $arr[$key] = (int)$value;
        }
        return $arr;

    }
    public function guardarCotizacion(Request $request){

        Cotizacion::validateCreate($request,Rule::class);
        

        $arr_cotizacion = [
            
            'id_cliente'            =>$request->id_cliente,
            'id_nivel_academico'    =>$request->nivel,
            'id_medio'              =>$request->medio,
            'curso'                 =>$request->curso,
            'avance'                =>$request->avance,
            'precio_total'          =>$request->precio,
            'validez'               =>$request->validez,
            'id_modalidad'          =>$request->modalidad,

        ];
        $arr_cotizacion = $this->parseInt($arr_cotizacion);

        $arr_cotizacion['tema'] = $request->tema;
        $arr_cotizacion['observaciones'] = $request->observacion;
        $arr_cotizacion['paralelo'] = $request->paralelo;


        
        if($request->nivel < 3){

            $arr_cotizacion['id_tipo_cotizacion']=2;
        }else{

            $arr_cotizacion['id_tipo_cotizacion']=$request->tipo_cotizacion;
        }
        
        $cotizacion = Cotizacion::create($arr_cotizacion);

        //Si el nivel es 1 o 2 es una cotización basica

        if($request->nivel < 3){
            CotizacionBasica::create([
                'id_cotizacion' => $cotizacion->id
            ]);

            
        }else{
            $profesion = $this->firstOrCreate($request->profesion,Profesion::class);

            $universidad = $this->firstOrCreate($request->universidad,Universidad::class);
            $cotizacion_universitaria = CotizacionUniversitaria::create([
                'id_cotizacion' => $cotizacion->id,
                'id_universidad'=> $universidad == null ? null : $universidad->id,
                'id_profesion'=>$profesion == null ? null : $profesion->id,
            ]);

            //Si el nivel es 3 o 4 es una cotizacion universitaria general
            if($request->nivel < 5){
                if($request->carrera!=null){
                    $id_carrera = Carrera::where('nombre',$request->carrera)->firstOr(function()use($request){
                        
                            return Carrera::create([
                                'nombre'=>$request->carrera,
                                'id_facultad' => $request->facultad,
                            ]);
                        }
                    )->id;
                }else{

                    $id_carrera = null;
                }
                
                CotizacionGeneral::create([
                    'id_cotizacion_universitaria' =>$cotizacion_universitaria->id,
                    'id_facultad'=>$request->facultad,
                    'id_carrera'=>$id_carrera
                ]);

            //Si el nivel es 5 o más es una cotizacion universitaria posgrado
            }else{
                $posgrado = $this->firstOrCreate($request->posgrado,Posgrado::class);

                CotizacionPosgrado::create([
                    'id_posgrado'=>$posgrado->id,
                    'id_cotizacion_universitaria' => $cotizacion_universitaria->id
                ]);
            }

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

        $cotizacion = Cotizacion::where('id',$id)
        ->with([
            'cliente',
            'modalidad',
            'tipoCotizacion',
            'nivelAcademico',
            'medio',
            'cotizacionUniversitaria' =>function($query){
                $query->with([
                    'cotizacionGeneral' =>function($query){
                        $query->with([
                            'facultad',
                            'carrera'
                        ]);
                    },
                    'cotizacionPosgrado'=>function($query){
                        $query->with([
                            'posgrado'
                        ]);
                    },
                ]);
            },
        ])
        ->firstorFail();
        
        $pdf = PDF::loadView('pdf.cotizacion_basica_pdf',[
            'cotizacion' => $cotizacion
        ]);
        
        return $pdf->setPaper('letter')->stream();

    }
}
