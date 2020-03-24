<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoAsesor extends Model
{
    protected $table = "pagos_asesor";
    protected $guarded = [];

    public function egreso(){
    	return $this->belongsTo(Egreso::class,'id_egreso');
    }
}
