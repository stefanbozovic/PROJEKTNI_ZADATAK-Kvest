<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Seat extends Model 
{
    public $seats_type=['Y'=>'Economy class','F'=>'First class','J'=>'Business class'];

    protected $table='seats';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_code','flight_id','number'
    ];

    protected $appends=['seat_class'];


    public function getSeatClassAttribute(){
        
        return $this->seats_type[$this->class_code];
    }
    public function flight(){
        return $this->belongsTo('App\Flight','flight_id','id');
    }
    public function client(){
        return $this->hasOne('App\Client');
    }
}

?>
