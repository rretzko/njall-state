<?php

namespace App\Imports;

use App\Models\Ensemble;
use App\Models\Event;
use App\Models\Instrumentation;
use App\Models\Participant;
use App\Traits\FindSchoolTrait;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    use FindSchoolTrait;
    /**
     * @param array $row
     *
     * array:6 [
     *  "first" => "Sophia"
     *  "last" => "Ashbabian"
     *  "year" => 2021
     *  "ensemble_id" => "Mixed Chorus"
     *  "schoolname" => "No Valley Reg HS at Old Tappan"
     *  "voicepart" => "Soprano I"
     *  ]
     *
     * @return \Illuminate\Database\Eloquent\Model/null
     */
    public function model(array $row)
    {
        static $cntr = 1;

        //first, last, event_id, school_id, instrumentation_id
        $properties = $this->map($row);

        if (!$properties) { //display input row to user

            echo 'found error @ row ' . $cntr . '!<br />';
            dd($row);
        }

        //upload non-duplicate record
        if (! $this->isDuplicate($properties)) {

            Participant::create($properties);
        }

        $cntr++;
    }

/** END OF PUBLIC FUNCTIONS =================================================*/

    private function isDuplicate(array $properties) : bool
    {
        return Participant::where('first', $properties['first'])
            ->where('last', $properties['last'])
            ->where('event_id', $properties['event_id'])
            ->where('ensemble_id', $properties['ensemble_id'])
            ->where('school_id', $properties['school_id'])
            ->where('instrumentation_id', $properties['instrumentation_id'])
            ->exists();
    }

    private function map(array $row)
    {
        $a = [];
        $a['first'] = trim($row['first']);
        $a['last'] = trim($row['last']);
        $a['event_id'] = (Event::where('year_of', $row['year'])->exists())
            ? Event::where('year_of', $row['year'])->first()->id
            : false;
        $a['ensemble_id'] = Ensemble::NJALLSTATEMIXED; //Ensemble::where('name', 'NJ All-State Mixed Choir')->first()->id;
        $a['school_id'] = $this->getSchoolId($row['schoolname']);
        $a['instrumentation_id'] = Instrumentation::where('descr', $row['voicepart'])->exists()
            ? Instrumentation::where('descr', $row['voicepart'])->first()->id
            : false;

        //if any property is false, return false
        return (in_array(false,$a))
            ? false
            : $a;
    }
}
