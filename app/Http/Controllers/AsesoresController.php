<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asesor;

class AsesoresController extends Controller
{
    public function buscarAsesorAjax(Request $request){
    	$asesor = new Asesor();
        echo json_encode($asesor->smartSearcher($request->string));

    }
}
