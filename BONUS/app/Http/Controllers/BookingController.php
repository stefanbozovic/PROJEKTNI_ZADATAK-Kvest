<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Flight;
use \App\Seat;
use \App\Client;


class BookingController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function store(Request $request,$seat_id,$filght_id){
        $seat=Seat::withCount("client")->where([['flight_id','=',$filght_id],['id','=',$seat_id]])->first();
        if($seat==NULL){
            return response(['error'=>'Seat not found.'],404);
        }
        if($seat->client_count>0){
            return response(['error'=>'Seat is already booked.'],404);
        }
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);
        $client=new Client($request->all());
        $client->booking_code=md5(time());
        $seat->client()->save($client);
        $seat->flight;
        return \response(['succes'=>[
            'message'=>'You have booked Flight for \''.$seat->seats_type[$seat->class_code].'\',save booking code: '.$seat->client->booking_code,
            'seat'=>$seat,
        ]],201);
    }
    public function find_store(Request $request,$class_code='Y',$filght_id){
        if(!($class_code=='Y' || $class_code=='F' || $class_code=='J')){
            return response(['error'=>'Class code doesn\'t exist use class codes ( F => First class, J => Business class , Y => Economy class)  '],404);
        }
        $seat=Seat::doesntHave("client")->where([['flight_id','=',$filght_id],['class_code','=',$class_code]])->first();
        if($seat==null){
            return response(['error'=>'All seats for that class have been booked.'],404);
        }
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);
        $client=new Client($request->all());
        $client->booking_code=md5(time());
        $seat->client()->save($client);
        $seat->flight;
        return \response(['succes'=>[
            'message'=>'You have booked Flight for \''.$seat->seats_type[$seat->class_code].'\' ,save booking code: '.$seat->client->booking_code,
            'seat'=>$seat,
        ]],201);
    }

    //
}
