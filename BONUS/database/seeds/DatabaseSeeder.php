<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        DB::table('flights')->insert([[
            'aircraft' => 'Boeing 777',
            'airport' => 'Serbia,Belgrade,Nikola Tesla',
            'from' => 'Serbia',
            'total_seats'=>177,
            'to' => 'Italy',
            'departure' => '12-24-2018 10:00:00',
            'arrival' =>'12-24-2018 13:30:00',
        ],[
            'aircraft' => 'Boeing 777',
            'airport' => 'Serbia,Belgrade,Nikola Tesla',
            'total_seats'=>177,
            'from' => 'Serbia',
            'to' => 'Germany',
            'departure' =>'12-23-2018 12:00:00' ,
            'arrival' => '12-23-2018 18:00:00',
        ],[
            'aircraft' => 'Boeing 777',
            'airport' => 'Germany,Munich,Munich Airport',
            'total_seats'=>177,
            'from' => 'Germany',
            'to' => 'Italy',
            'departure' =>'12-24-2018 13:30:00',
            'arrival' => '12-24-2018 16:00:00',
        ]]);

        for($i=0;$i<15;$i++){
            DB::table('seats')->insert([[
                'flight_id'=>1,
                'class_code'=>'F',
                'number'=>$i,
                'price'=>374.59,
            ],[
                'flight_id'=>2,
                'class_code'=>'F',
                'number'=>$i,
                'price'=>349.99,
            ],[
                'flight_id'=>3,
                'class_code'=>'F',
                'number'=>$i,
                'price'=>399.99,
            ]]);
        }
        for($i=15;$i<47;$i++){
            DB::table('seats')->insert([[
                'flight_id'=>1,
                'class_code'=>'J',
                'number'=>$i,
                'price'=>199.99,
            ],[
                'flight_id'=>2,
                'class_code'=>'J',
                'number'=>$i,
                'price'=>179.55,
            ],[
                'flight_id'=>3,
                'class_code'=>'J',
                'number'=>$i,
                'price'=>212.39,
            ]]);
        }
        for($i=47;$i<177;$i++){
            DB::table('seats')->insert([[
                'flight_id'=>1,
                'class_code'=>'Y',
                'number'=>$i,
                'price'=>112.49,
            ],[
                'flight_id'=>2,
                'class_code'=>'Y',
                'number'=>$i,
                'price'=>123.39,
            ],[
                'flight_id'=>3,
                'class_code'=>'Y',
                'number'=>$i,
                'price'=>145.39,
            ]]);
        }
    }
}
