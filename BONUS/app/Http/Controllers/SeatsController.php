<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Flight;
use \App\Seat;


class SeatsController extends Controller
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
    public function index(Request $request,$id){
        $seats=Seat::doesntHave("client")->where('flight_id','=',$id)->get();
        if($seats->count()==0){
            return response(['error'=>'Flight not available'],404);
        }
        return response($seats);
    }

    public function show(Request $request,$id,$seat_id){
        $seat=Seat::withCount('client as booked')->where([['flight_id','=',$id],['id','=',$seat_id]])->first();
        if($seat==null){
            return response(["error"=>"Seat have not been found"],404);
        }
        if($seat->booked==0)
            return response([
                    'message'=>'This seat is available',
                    'seat'=>$seat
                ]);
            return response([
                    'message'=>'This seat is already booked',
                    'seat'=>$seat
                ]);
    }


    //
}
