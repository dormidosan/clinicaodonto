<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    //
    protected $table = 'expedientes';

    public function controles()
    {
        return $this->hasMany('App\Control');
    }

    public function fotos()
    {
        return $this->hasMany('App\Foto');
    }

	public function alergias()
    {
        return $this->belongsToMany('App\Alergia','alergia_expediente')->withTimestamps();
    }

    public function observaciones()
    {
        return $this->belongsToMany('App\Observacion','expediente_observacion')->withTimestamps();
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function telefonos()
    {
        return $this->hasMany('App\Telefono');
    }

    //foraneas
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    public function tipo_sanguineo()
    {
        return $this->belongsTo('App\TipoSanguineo');
    }
    
}
