<?php

namespace App\Imports;

use App\Models\Artist;
use App\Models\Artisttype;
use App\Models\Composition;
use App\Models\Event;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompositionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $compositions = $this->findSimilarTitles($row['title']);
        $composerid = $this->findArtistId($row['composer']);
        $arrangerid = $this->findArtistId($row['arranger']);

        if(! $compositions->count()){

            $composition = Composition::create([
                'title' => $row['title'],
                'subtitle' => $row['subtitle'],
            ]);

            $event_id = $this->findEventId($row['year']);

            $composition->events()->attach($event_id,['opener' => 0,'closer' => 0, 'combined' => 0, 'order_by' => 1]);

            if($composerid){ $composition->artists()->attach($composerid, ['artisttype_id' => Artisttype::COMPOSER]);}
            if($arrangerid){ $composition->artists()->attach($arrangerid, ['artisttype_id' => Artisttype::ARRANGER]);}

        }else{

            dd($compositions);
        }


        return $composition;
    }

/** END OF PUBLIC FUNCTION  ==================================+++++++++++++++*/

    private function findArtistId($artist): int
    {
        //early exit
        if(! strlen($artist)){ return 0;}

        $parts = explode(' ', $artist);
        $lastname = $parts[(count($parts) - 1)];
        $firstname = $parts[0];

        $artists = Artist::where('last', $lastname)->get();

        if(! $artists){ return 0;}

        foreach($artists AS $artist){

            if($artist->first == $firstname){ //artist found

                return $artist->id;
            }
        }

        //no artist found: Create artist
        $artist = Artist::create([
           'first' => $firstname,
           'last' => $lastname,
        ]);

        return $artist->id;
    }

    private function findEventId($year): int
    {
        return Event::where('year_of', $year)->first()->id;
    }

    private function findSimilarTitles($title): Collection
    {
        $c = Composition::where('title', $title)->get();

        return $c ?: collect();
    }
}
