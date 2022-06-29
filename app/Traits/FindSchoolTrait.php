<?php

namespace App\Traits;

use App\Models\School;

trait FindSchoolTrait
{
    private $map;

    public function __construct()
    {
        $this->map = $this->buildMap();
    }

    public function getSchoolId($schoolname) : int
    {
        $id = 0;

        //$schoolname in database
        if(School::where('name', $schoolname)->exists()) {

            $id = School::where('name', $schoolname)->first()->id;

        }elseif(School::where('name', str_replace(' HS', '', $schoolname))->exists()){

            //strip HS from $schoolname
            $id = School::where('name', str_replace(' HS', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' MS/HS', '', $schoolname))->exists()){

            //strip MS/HS from $schoolname
            $id = School::where('name', str_replace(' MS/HS', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' Reg HS', '', $schoolname))->exists()){

            //strip Reg HS from $schoolname
            $id = School::where('name', str_replace(' Reg HS', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' RHS', '', $schoolname))->exists()){

            //strip RHS from $schoolname
            $id = School::where('name', str_replace(' RHS', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' Regional', '', $schoolname))->exists()){

            //strip Regional from $schoolname
            $id = School::where('name', str_replace(' Regional', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' School', '', $schoolname))->exists()){

            //strip School from $schoolname
            $id = School::where('name', str_replace(' School', '', $schoolname))->first()->id;

        }elseif(School::where('name', str_replace(' Township HS', '', $schoolname))->exists()){

            //strip School from $schoolname
            $id = School::where('name', str_replace(' Township HS', '', $schoolname))->first()->id;

        }elseif(array_key_exists($schoolname, $this->map)){

            $id = $this->map[$schoolname];
        }else{

            dd($schoolname);
        }

        return $id;
    }

    /** END OF PUBLIC FUNCTIONS  ++++++++++++++++++++++++++++++++++++++++++++*/

    private function buildMap()
    {
        return [
            'Audubon Jr/Sr HS' => 19,
            'Audubon JR/SR HS' => 19,
            'Bergen Co Academies' => 712,
            'Bergen County Acad' => 712,
            'Bergen Co Academy' => 712,
            'Bishop Eustace Prep' => 726,
            'Brick Twp Mem HS' => 721,
            'Bridgewater-Raritan Regional HS' => 55,
            'Camden Co Tech School' => 756,
            'Charter-Tech HS' => 759,
            'Christian Academy' => 728, //Hawthorne Christian Academy
            'Clearview Reg HS' => 95,
            'Cramford HS' => 115, //typo: Cranford HS
            'Cranford HS' => 115,
            'Cresskilll HS' => 116, //typo Creskilll
            'Dseneca' => 759, //typo for Seneca HS
            'Dseneca HS' => 759, //typo for Seneca HS
            'Eastern Senior HS' => 711,
            'Egg Harbor Twp HS' => 149,
            'Freehold Twp HS' => 176,
            'Gateway Regional HS' => 180,
            'Gill St Bernards School' => 181,
            'Haddon Twp HS' => 194,
            'Hanover Park HS' => 213,
            'Hawthorne Christian Acad' => 728,
            'High Point Regional HS' => 221,
            'Hillborough HS' => 657, //typo for Hillsborough
            'Hunterdon Cent Reg HS Dist' => 244,
            'Hunterdon Central Regional HS' => 244,
            'John P Stevents HS' => 247, //typo for J P Stevens
            'John P Stevens' => 247,
            'John P. Stevens' => 247,
            'John P. Stevens HS' => 247,
            'Madison HS' => 295,
            'Mahway HS' => 297, //typo for Mahwah
            'Mainland Regional HS' => 300,
            'Matawan HS' => 316,
            'Middle Township HS' => 324,
            'Monroe Twp HS' => 339,
            'Montville Twp HS' => 342,
            'Morris Knoll HS' => 352, //typo for Morris Knolls
            'N Burlington Co Reg HS' => 375,
            'No Bur Co Reg HS' => 375,
            'No Highlands Reg HS' => 383,
            'No Jersey Home Sch Assn' => 700,
            'No Valley Reg HS/Old Tappan' => 388,
            'No Valley Reg HS at Old Tappan' => 388,
            'Norther Burlington County Regional HS' => 714, //type with Norther
            'Northern Burlington Co Regional HS' => 714,
            'Norther Highlands Regional HS' => 383, //type with Norther
            'North Hunterdon Regional HS' => 378,
            ' Northern Valley Regional HS' => 386, //typo with leading space
            'Northern Valley Regional Demarest' => 379,
            'Overbrook Senior HS' => 406,
            'Parsippany Hills HS' => 412,
            'Pascack Valley HS' => 416,
            'Passaic Valley HS' => 420,
            'Pemberton HS' => 427,
            'River Dell Reg HS' => 478,
            'Rutgers Prep School' => 640,
            'Shawnee Regional HS' => 498,
            'Tomes River East HS' => 535, //typo for Toms River
            'W Morris Mendham' => 599,
            'W Morris Mendham HS' => 599,
            'Westfield Senior High' =>613,
            'Washington Twp HS' => 572,
            'Woodtown HS' => 628, //typo for Woodstown HS

        ];
    }

}
