<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Client extends Model 
{
    protected $table='clients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','seat_id','phone','email','passport'
    ];

    public function seat(){
        return $this->belongTo('App\Seat');
    }
}

?>
