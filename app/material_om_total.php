<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material_om_total extends Model
{  

    protected $fillable = ['material_id', 'om', 'saldo'];
    
    public function material()
    {
        return $this->hasOne('App\Material');
    }

    public function retirada($consumo){
        $this->saldo -= $consumo;
        $this->save();
     
    }
    public $timestamps = false;
   protected $table = 'material_om_total';
}
