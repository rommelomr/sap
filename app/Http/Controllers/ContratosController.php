<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Cotizacion;
use App\Contrato;
use App\FichaAcademica;

class ContratosController extends Controller
{
	private function loadResources(){
		$contratos = Contrato::with(['asesor'=>function($query){
			$query->with(['usuario'=>function($query){
				$query->with('persona');
			}]);
		},'cliente'=>function($query){
			$query->with('persona');
		},'tipoContrato','usuarioDaf'=>function($query){
			$query->with(['usuario'=>function($query){
				$query->with('persona');
			}]);
		}])->paginate(10);
		return [
			'contratos' => $contratos
		];
	}
	public function index(){
		$arr = $this->loadResources();
		return view('contratos.contratos',$arr);
	}
	public function buscarContrato(Request $request){
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
        $contratos = Contrato::smartSearcher($request->string);
        $contratos = $contratos->whereYear('created_at',$date['y'])->whereMonth('created_at',$date['m'])->paginate(10);
        return view('contratos.contratos',['contratos'=>$contratos]);
        dd($contratos);
	}
	public function crearContrato(Request $req){
		session()->flash('contrato',true);
		$msg = [
			'id_asesor.required'=>'No se ha seleccionado un Asesor válido',
			'id_daf.required'=>'No se ha seleccionado un DAF válido',
			'id_daf.different'=>'El DAF y el Asesor no pueden ser la misma persona',
			'id_tipo_contrato.required' => 'Debe seleccionarse un Tipo de Contrato',
		];
		$req->validate([
			'id_ficha' => 'required|exists:fichas_academicas,id',
			'id_asesor' => 'required|exists:asesores,id',
			'id_tipo_contrato' => 'required|exists:contratos,id',
			'monto' => 'required|numeric',
			'id_daf' => 'required|exists:asesores,id|different:id_asesor',
		],$msg);
		session()->forget('contrato');
		$ficha = FichaAcademica::with(['cotizacion'=>function($query){
			$query->with('fichaEconomica');
		}])->find($req->id_ficha);
		$contrato = Contrato::create([
			'id_asesor'=> $req->id_asesor,
			'id_cliente'=> $ficha->cotizacion->id_cliente,
			'id_tipo_contrato'=> $req->id_tipo_contrato,
			'monto'=> $req->monto,
			'daf'=> $req->id_daf,
		]);

		$ficha->id_asesor = $req->id_asesor;
		$ficha->id_contrato = $contrato->id;
		$ficha->cotizacion->fichaEconomica->id_contrato = $contrato->id;
		$contrato->numero_contrato = $contrato->id.'/'.date('Y');
		$contrato->save();
		$ficha->push();
		return redirect()->back()->with(['messages'=>[
			'Se ha realizado el contrato correctamente'
		]]);
	}
}
