<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    protected $table = 'matches';

    public $primaryKey = 'id';

    public $timestamps = 'true';

    public function user1() {
        return $this->belongsTo('App\User', 'user_id_1');
    }

    public function user2() {
        return $this->belongsTo('App\User', 'user_id_2');
    }

    function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
    {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch ($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
        }
        return round($distance, $decimals);
    }
}
