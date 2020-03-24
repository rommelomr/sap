<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoIngreso;
use App\TipoPago;
use App\TipoEgreso;
use App\Cotizacion;
use App\Ingreso;
use App\Egreso;
use App\Contrato;
use App\PagoAsesor;
use App\PagoCliente;
use App\FichaEconomica;
use App\Modalidad;
use Barryvdh\DomPDF\Facade as PDF;

class FichasEconomicasController extends Controller
{
    private function actualizarPago($class,$req){
        $pago = $class::find($req->id);
        $pago->monto = $req->monto;
        $pago->save();
    }
    public function actualizarFicha(Request $req){
        $req->validate([
            'tipo'=>'bail|required|in:ingreso,egreso',
            'id'=>['required',function($attr,$value,$fail)use($req){
                if($req->tipo === 'ingreso'){
                    $req->validate([
                        'id'=>'exists:ingresos,id'
                    ]);
                }else if($req->tipo === 'egreso'){
                    $req->validate([
                        'id'=>'exists:egresos,id'
                    ]);
                }else{
                    $fail('El registro de pago no se ha encontrado');
                }
            }],
            'monto'=>'required|numeric',
        ]);
        if($req->tipo === 'ingreso'){
            $this->actualizarPago(Ingreso::class,$req);
            $tab = 'ingreso';
        }else{
            $this->actualizarPago(Egreso::class,$req);
            $tab = 'egreso';
        }
        return redirect()->back()->with(['tab'=>$tab]);
    }
    
    public function pagarCliente(Request $req){
        $messages = [

        ];
        session()->flash('open','cliente');
        session()->flash('tab','ingreso');
        $req->validate([
          "id_cliente" => ['required','exists:clientes,id'],
          "id_ficha_economica" => ['required','exists:fichas_economicas,id'],
          "cliente_id_tipo_pago" => ['required','exists:tipos_pago,id'],
          "cliente_id_modalidad" => ['required','exists:modalidades,id'],
          "cliente_numero_recibo" => ['required','numeric'],
          "cliente_monto" => ['required','numeric'],
          "cliente_concepto" => ['required'],
        ]);
        //Registrar Ingreso
        $ingreso = Ingreso::create([
            'id_tipo_pago' => $req->cliente_id_tipo_pago,
            'id_tipo_ingreso' => 1,
            'concepto' => $req->cliente_concepto,
            'numero_recibo' => $req->cliente_numero_recibo,
            'monto' => $req->cliente_monto,
        ]);
        //Registrar PagoCliente
        PagoCliente::create([
            'id_modalidad' => $req->cliente_id_modalidad,
            'id_ingreso' => $ingreso->id,
            'id_usuario' => \Auth::user()->id,
            'id_ficha_economica' => $req->id_ficha_economica
        ]);
        return redirect()->back()->with([
            'messages' => ['Pago de cliente registrado con éxito'],
        ]);
    }
    
    public function pagarAsesor(Request $req){
        session()->flash('open','asesor');
        session()->flash('tab','egreso');
        $req->validate([
          "id_asesor" => ['required','exists:personas,id'],
          "asesor_tipo_pago" => ['required','exists:tipos_pago,id'],
          "asesor_id_modalidad" => ['required','exists:modalidades,id'],
          "asesor_monto" => ['required','numeric'],
          "asesor_numero_recibo" => ['required','numeric'],
          "asesor_concepto" => ['required'],
        ]);
        $usuario = \Auth::user();
        //Recordar validar error de si no se encuentra: "Error inesperado. Vuelva a intentarlo"
        $egreso = Egreso::create([
            'id_tipo_pago' => $req->asesor_tipo_pago,
            'id_tipo_egreso' => 2,
            'monto' => $req->asesor_monto,
            'numero_recibo' => $req->asesor_numero_recibo,
            'concepto' => $req->asesor_concepto,
        ]);
        $ficha_economica = FichaEconomica::with('cotizacion')->find($req->id_ficha_economica);
        PagoAsesor::create([
            'id_usuario' => $usuario->id,
            'id_modalidad' => $ficha_economica->cotizacion->id_modalidad,
            'id_asesor' => $req->id_asesor,
            'id_egreso' => $egreso->id,
            'id_ficha_economica' => $req->id_ficha_economica
        ]);
        return redirect()->back()->with(['messages'=>['Pago al asesor realizado correctamente']]);
        
    }
    
    public function verFicha($id){
        $ficha = FichaEconomica::with(['pagosAsesor'=>function($query){
                $query->with('egreso');
            },'pagosCliente'=>function($query){
                $query->with('ingreso');
            },'cotizacion'=>function($query){
                $query->with(['ficha'=>function($query){
                    $query->with(['contrato'=>function($query){
                        $query->with(['asesor'=>function($query){
                            $query->with(['usuario'=>function($query){
                                $query->with('persona');
                            }]);
                        }]);
                    }]);
                },'cliente'=>function($query){
                    $query->with('persona');
                }]);
            },
        ])->where('id_cotizacion',$id)->first();

        if($ficha->id_contrato == null){
            return view('fichas.ficha_economica_error');
        }else{
            $pagos_asesor = PagoAsesor::with('egreso')->orderBy('created_at','DESC')->where('id_ficha_economica',$ficha->id)->paginate(10,['*'],'pagos');
            $pagos_cliente = PagoCliente::with('ingreso')->orderBy('created_at','DESC')->where('id_ficha_economica',$ficha->id)->paginate(10,['*'],'ingresos');

            $abono_cliente = Ingreso::whereHas('pagoCliente',function($query) use ($ficha){
                $query->where('id_ficha_economica',$ficha->id);
            })->sum('monto');
            
            $abono_asesor = Egreso::whereHas('pagoAsesor',function($query) use ($ficha){
                $query->where('id_ficha_economica',$ficha->id);
            })->sum('monto');

            $tipos_pago = TipoPago::all();
            $tipos_egreso = TipoEgreso::all();
            $tipos_ingreso = TipoIngreso::all();
            $modalidades = Modalidad::all();
            return view('fichas.fichas_economicas',[
                'ficha'=>$ficha,
                'pagos_asesor'=>$pagos_asesor,
                'pagos_cliente'=>$pagos_cliente,
                'tipos_egreso'=>$tipos_egreso,
                'tipos_pago'=>$tipos_pago,
                'tipos_ingreso'=>$tipos_ingreso,
                'modalidades'=>$modalidades,
                'abono_asesor'=>$abono_asesor,
                'abono_cliente'=>$abono_cliente,
            ]); 
        }
    }
    public function exportPdffichaE($id)
    {
        $ficha_e = FichaEconomica::with([
            'contrato'=>function($query){
                $query->with(['asesor'=>function($query){
                    $query->with(['usuario'=>function($query){
                        $query->with('persona');
                    }]);
                }]);
            }
            ,'cotizacion'=>function($query){
                $query->with(['cliente'=>function($query){
                    $query->with('persona');
                }]);
            }
            ,'pagosAsesor','pagosCliente'])->find($id);

        $pdf = PDF::loadView('pdf.ficha_economica',['ficha_e'=>$ficha_e]);
        return $pdf->setPaper('a4')->stream();

    }
}
