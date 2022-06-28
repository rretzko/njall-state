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
            'Audubon JR/SR HS' => 19,
            'Bergen Co Academies' => 712,
            'Bergen County Acad' => 712,
            'Brick Twp Mem HS' => 721,
            'Camden Co Tech School' => 756,
            'Charter-Tech HS' => 759,
            'Christian Academy' => 728, //Hawthorne Christian Academy
            'Clearview Reg HS' => 95,
            'Cramford HS' => 115, //typo: Cranford HS
            'Cranford HS' => 115,
            'Dseneca' => 759, //typo for Seneca HS
            'Dseneca HS' => 759, //typo for Seneca HS
            'Egg Harbor Twp HS' => 149,
            'Haddon Twp HS' => 194,
            'Hawthorne Christian Acad' => 728,
            'Hunterdon Cent Reg HS Dist' => 244,
            'John P Stevents HS' => 247, //typo for J P Stevens
            'John P Stevens' => 247,
            'John P. Stevens' => 247,
            'John P. Stevens HS' => 247,
            'Monroe Twp HS' => 339,
            'Montville Twp HS' => 342,
            'N Burlington Co Reg HS' => 375,
            'No Bur Co Reg HS' => 375,
            'No Highlands Reg HS' => 383,
            'No Jersey Home Sch Assn' => 700,
            'No Valley Reg HS/Old Tappan' => 388,
            'No Valley Reg HS at Old Tappan' => 388,
            'Overbrook Senior HS' => 406,
            'Parsippany Hills HS' => 412,
            'Pascack Valley HS' => 416,
            'Pemberton HS' => 427,
            'River Dell Reg HS' => 478,
            'Rutgers Prep School' => 640,
            'W Morris Mendham' => 599,
            'W Morris Mendham HS' => 599,
            'Westfield Senior High' =>613,
            'Washington Twp HS' => 572,
            'Woodtown HS' => 628, //typo for Woodstown HS

        ];
    }

}
