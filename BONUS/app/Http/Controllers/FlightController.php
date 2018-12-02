<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Flight;
use \Carbon\Carbon ;

class FlightController extends Controller
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
    public function index(Request $request){
        $flights=\App\Flight::where("airport","like","%".$request->from."%");
        if(isset($request->to)){
            $flights=\App\Flight::where("to","like","%".$request->to."%");
        }
        if(isset($request->departure)){
            $flights=\App\Flight::where("departure","like","%".$request->departure."%");
        }
        if(isset($request->arrival)){
            $flights=\App\Flight::where("arrival","like","%".$request->arrival."%");
        }
        return response($flights->get(['id','airport','aircraft','total_seats','from','to','departure','arrival'])->toJson(JSON_PRETTY_PRINT));
    }

    public function show(Request $request,$id){
        $flight=\App\Flight::where("id","=",$id)->first();
        if($flight==null){
            return response(['error'=>'Flight not available'],404);
        }
        return response($flight);
    }

    //
}
