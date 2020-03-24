<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimiento;
use App\CajaChica;
use App\TipoPago;
use App\TipoIngreso;
use App\TipoEgreso;
use App\Ingreso;
use App\Egreso;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CajaChicaController extends Controller
{
    private function cargarRecursos($except = null){

        $arr = [];
		$arr['monto_caja_chica'] = CajaChica::obtenerMonto();
        $arr['tipos_pago'] = TipoPago::all();
        $arr['tipos_ingreso'] = TipoIngreso::all();
        $arr['tipos_egreso'] = TipoEgreso::all();

        if($except!==1){

     		$arr['cargas'] = Movimiento::with(['usuario'=>function($query){
     			$query->with('persona');
     		}])->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->where('tipo',1)->paginate(10,['*'], 'cargas');

        }
        if($except!==2){

     		$arr['retiros'] = Movimiento::with(['usuario'=>function($query){
     			$query->with('persona');
     		}])->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->where('tipo',2)->paginate(10,['*'], 'retiros');
            
        }
        if($except!==3){
            $arr['ingresos'] = Ingreso::with(['tipoIngreso','tipoPago'])->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->paginate(10,['*'], 'ingresos');
            
        }
        if($except!==4){
            $arr['egresos'] = Egreso::with('tipoPago')->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->paginate(10,['*'], 'egresos');
            
        }
        
    	return view('movimientos',$arr);
    }
    public function index(){
        $array = $this->cargarRecursos();
        return $array;
    }
    public function buscarCarga(Request $request){
        $request->validate([
            'date' => ['required']
        ]);
        $input = explode('-',$request->date);
        if(count($input) === 2){
            $date = [
                'y' => $input[0],
                'm' => $input[1],
            ];
        }else{
            return redirect()->back()->with(['messages'=>['formato de fecha inválido']]);
        }
        $movimientos = Movimiento::smartSearcher($request->string)->whereYear('created_at',$date['y'])->whereMonth('created_at',$date['m'])->where('tipo',1)->paginate(10,['*'], 'cargas');
        $array = $this->cargarRecursos(1);
        $array['cargas'] = $movimientos;
        session()->flash('cargas',true);
        return $array;
    }
    public function buscarRetiro(Request $request){
        $request->validate([
            'date' => ['required']
        ]);
        $input = explode('-',$request->date);
        if(count($input) === 2){
            $date = [
                'y' => $input[0],
                'm' => $input[1],
            ];
        }else{
            return redirect()->back()->with(['messages'=>['formato de fecha inválido']]);
        }
        $movimientos = Movimiento::smartSearcher($request->string)->whereYear('created_at',$date['y'])->whereMonth('created_at',$date['m'])->where('tipo',2)->paginate(10,['*'], 'retiros');
        $array = $this->cargarRecursos(2);
        $array['retiros'] = $movimientos;
        session()->flash('tab_retiro_caja_chica',true);
        return $array;
    }
    public function buscarIngreso(Request $request){
        $request->validate([
            'date' => ['required']
        ]);
        $input = explode('-',$request->date);
        if(count($input) === 2){
            $date = [
                'y' => $input[0],
                'm' => $input[1],
            ];
        }else{
            return redirect()->back()->with(['messages'=>['formato de fecha inválido']]);
        }
        $ingresos = Ingreso::smartSearcher($request->string)->whereYear('created_at',$date['y'])->whereMonth('created_at',$date['m'])->paginate(10,['*'], 'ingresos');
        $array = $this->cargarRecursos(3);
        $array['ingresos'] = $ingresos;
        session()->flash('ingresos',true);
        return $array;
    }
    public function buscarEgreso(Request $request){
        $request->validate([
            'date' => ['required']
        ]);
        $input = explode('-',$request->date);
        if(count($input) === 2){
            $date = [
                'y' => $input[0],
                'm' => $input[1],
            ];
        }else{
            return redirect()->back()->with(['messages'=>['formato de fecha inválido']]);
        }
        $egresos = Egreso::smartSearcher($request->string)->whereYear('created_at',$date['y'])->whereMonth('created_at',$date['m'])->paginate(10,['*'], 'egresos');

        $array = $this->cargarRecursos(4);
        $array['egresos'] = $egresos;
        session()->flash('egresos',true);
        return $array;
    }
    
    public function crearEgreso(Request $request){
        $msg = [
            'monto.required'=>'Debe ingresar un monto',
            'monto.numeric'=>'El monto debe ser numérico',
            'concepto.required'=>'Debe ingresar un concepto',
            'numero_recibo.required'=>'Debe ingresar un número de recibo',
            'numero_recibo.numeric'=>'El numero de recibo debe ser numérico',
            'id_tipo_pago.required'=>'Debe ingresar un tipo de pago',
            'id_tipo_pago.exists'=>'El tipo de pago no es válido',
            'id_tipo_egreso.required'=>'Debe ingresar un tipo de egreso',
            'id_tipo_egreso.exists'=>'El tipo de egreso no es válido',
        ];
        session()->flash('crear_egreso',true);
        $request->validate([
          'monto' => ['required','numeric'],
          'concepto' => ['required'],
          'numero_recibo' => ['required','numeric'],
          'id_tipo_pago' => ['required','exists:tipos_pago,id'],
          'id_tipo_egreso' => ['required','exists:tipos_egreso,id'],
        ],$msg);
        session()->forget('crear_egreso');
        Egreso::create([
          'monto' => $request->monto,
          'concepto' => $request->concepto,
          'numero_recibo' => $request->numero_recibo,
          'id_tipo_pago' => $request->id_tipo_pago,
          'id_tipo_egreso' => $request->id_tipo_egreso,
        ]);
        return redirect()->back()->with(['messages'=>['Egreso realizado exitosamente']]);
    }
    public function crearIngreso(Request $request){
        $msg = [
            'monto.required' => 'El campo Monto es obligatorio',
            'monto.numeric' => 'El campo Monto debe ser un número',
            'concepto.required' => 'El campo Concepto es obligatorio',
            'numero_recibo.required' => 'El campo Número de Recibo es obligatorio',
            'numero_recibo.numeric' => 'El campo Npumero de Recibo debe ser un número',
            'id_tipo_pago.required' => 'El campo Tipo de Pago es obligatorio',
            'id_tipo_pago.numeric' => 'El campo Tipo de Pago no es válido',
            'id_tipo_pago.exists' => 'El campo Tipo de Pago no es válido',

        ];
        session()->flash('ingreso',true);
        $request->validate([
            'monto' => ['required','numeric'],
            'concepto' => ['required'],
            'numero_recibo' => ['required','numeric'],
            'id_tipo_pago' => ['required','numeric','exists:tipos_pago,id'],
        ]);
        session()->forget('ingreso');
        Ingreso::create([
            'id_tipo_ingreso' => 2,
            'id_tipo_pago' => $request->id_tipo_pago,
            'concepto' => $request->concepto,
            'numero_recibo' => $request->numero_recibo,
            'monto' => $request->monto,
        ]);
        return redirect()->back()->with(['messages'=>['Ingreso registrado exitosamente']]);
    }
    public function crearCarga(Request $request){
    	$msg = [
    		'monto.required'=>'Debe ingresar un monto',
    		'monto.numeric'=>'El monto debe ser numérico',
    		'monto.min:1'=>'Debe ingresar como minimo 1 Bs al monto',
  			'concepto.required'=>'Debe ingresar un concepto',
    	];
    	session()->flash('carga',true);
    	$request->validate([
    		"monto" => ['required','numeric','min:1'],
  			"concepto" => ['required'],
    	],$msg);
    	session()->forget('carga');
    	$auth = Auth::user();
    	Movimiento::create([
			'id_usuario' => $auth->id,
			'tipo' => 1,
			'monto' => $request->monto,
			'concepto' => $request->concepto,
    	]);
    	$caja_chica = CajaChica::first();
    	$caja_chica->monto += $request->monto;
    	$caja_chica->save();
    	return redirect()->back()->with([
    		'messages'=>['Carga realizada exitosamente'],
    		'monto_caja_chica'=>$caja_chica->monto,
    	]);
    }
    
    public function retirarMonto(Request $request){

    	$caja_chica = CajaChica::first();
        if($caja_chica->monto <= 0){
            return redirect()->back()->with(['messages'=>['La caja está vacía']]);
        }
    	$msg = [
		  'monto.required' => 'Debe ingresar un monto',
		  'monto.numeric' => 'El monto debe ser numérico',
		  'monto.max' => 'El monto no debe pasar los '.$caja_chica->monto,
		  'monto.min' => 'El monto no debe ser menor a 0',
		  'concepto.required' => 'Debe ingresar un concepto',
    	];

    	session()->flash('tab_retiro_caja_chica',true);
    	
    	$request->validate([
		  "monto" => ['required','numeric','max:'.$caja_chica->monto,'min:1'],
		  "concepto" => ['required']
    	],$msg);
    	session()->forget('tab_retiro_caja_chica');

    	$auth = Auth::user();
    	Movimiento::create([
			'id_usuario' => $auth->id,
			'tipo' => 2,
			'monto' => $request->monto,
			'concepto' => $request->concepto,
    	]);
    	$caja_chica->monto -= $request->monto;
    	$caja_chica->save();
    	return redirect()->back()->with(['messages'=>['Retiro realizado exitosamente']]);
    }
}
