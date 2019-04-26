<?php
/**
 * Created by PhpStorm.
 * User: campbellbrobbel
 * Date: 24/3/19
 * Time: 5:32 PM
 */

namespace App\MingleLibrary;
use App\MingleLibrary\Models\Ignored;
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
        $postcode = $attr->postcodeObject;
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
        $attributes =  UserAttributes::join('postcodes', 'user_attributes.postcode', '=', 'postcodes.id')
            ->where('user_id','!=', $attr['user_id'])
            ->where('interested_in', $attr['gender'])
            ->where('gender', $attr['interested_in'])
            ->selectRaw("user_attributes.*, $rawWhereString as `score`, postcodes.latitude, postcodes.longitude, ".$distanceString." as distance")
            ->orderByRaw($orderByRaw)
            ->take($limit)
            ->skip(($page - 1) * $limit)
            ->get();
        $ignored = Ignored::where('user_id_1', $attr->user_id)->get();
        foreach ($attributes as $attKey => $att)   {
            foreach ($ignored as $iKey => $ignore)    {
                if($ignore->user_id_2 == $att->user_id)   {
                    unset($attributes[$attKey]);
                }
            }
        }


        return $attributes;
    }
}