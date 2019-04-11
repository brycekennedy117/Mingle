<?php
/**
 * Created by PhpStorm.
 * User: campbellbrobbel
 * Date: 24/3/19
 * Time: 5:32 PM
 */

namespace App\MingleLibrary;
use App\MingleLibrary\Models\Postcode;
use App\MingleLibrary\Models\UserAttributes as UserAttributes;

class MatchMaker
{
    /**
     * @param $attr
     * @param array $orderBy
     * @param int $limit
     * @param int $page
     * @return mixed
     *
     * Returns a list of UserAttribute objects who are likely good matches with a user.
     */
    function getPotentialMatches($attr, $orderBy=['score desc'], $limit=10, $page=1) {

        $postcode = Postcode::all()->where('postcode', $attr['postcode']);
        $openness = $attr['openness'];
        $conscientiousness = $attr['conscientiousness'];
        $extraversion = $attr['extraversion'];
        $agreeableness = $attr['agreeableness'];
        $neuroticism = $attr['neuroticism'];
        $rawWhereString = "round((abs(openness - $openness) + abs(conscientiousness - $conscientiousness) + abs(extraversion - $extraversion) + abs(agreeableness - $agreeableness) + abs(neuroticism - $neuroticism)) / 5,2) ";
        $latitude = $postcode['latitude'];
        $longitude = $postcode['longitude'];

        $orderByRaw = "";
        foreach ($orderBy as $key=>$item) {
            $orderByRaw = "$orderByRaw$item";
        }
        $distanceString = "round(1.60934 * 2 * 3961 * asin(sqrt(pow(sin(radians(($latitude - latitude)/2)),2) + cos(radians($latitude)) * cos(radians(latitude)) * pow(sin(radians(($longitude-longitude)/2)),2))),2)";
        $attributes =  UserAttributes::where('user_id','!=', $attr['user_id'])
            ->where('interested_in', $attr['gender'])
            ->where('gender', $attr['interested_in'])
            ->selectRaw("*, $rawWhereString as `score`, latitude, longitude, ".$distanceString."as distance")
            ->whereRaw("$rawWhereString > 0.0 and ".$distanceString." < 30")
            ->orderByRaw($orderByRaw)
            ->take($limit)
            ->skip(($page - 1) * $limit)
            ->get();

        return $attributes;
    }
}