<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Flight extends Model 
{
    protected $table='flights';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'airport','aircraft','from','to','departure','arrival'
    ];
    public function seats(){
        return $this->hasMany("App\Seat");
    }
}

?>
