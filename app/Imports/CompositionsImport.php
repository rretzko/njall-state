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
        static $cntr = 1;

        $composition = $this->findSimilarTitles($row['title']);
        $composerid = $this->findArtistId($row['composer']);
        $arrangerid = $this->findArtistId($row['arranger']);

        if($composition->id){

            $event_id = $this->findEventId($row['year']);

            $composition->events()->attach($event_id,['opener' => 0,'closer' => 0, 'combined' => 0, 'order_by' => $cntr]);

            $cntr++;

            if($composerid){ $composition->artists()->attach($composerid, ['artisttype_id' => Artisttype::COMPOSER]);}
            if($arrangerid){ $composition->artists()->attach($arrangerid, ['artisttype_id' => Artisttype::ARRANGER]);}

        }else{

            dd($composition);
        }

        return $composition;
    }

/** END OF PUBLIC FUNCTION  ==================================+++++++++++++++*/

    private function findArtistId($artist): int
    {
        //early exit
        if(! strlen($artist)){ return 0;}

        $parts = explode(' ', $artist);
        $lastname = array_pop($parts); //[(count($parts) - 1)];
        $firstname = implode(' ', $parts);

        $artist = Artist::where('first', $firstname)
            ->where('last', $lastname)
            ->firstOr(function() use($firstname, $lastname){
                Artist::create(
                    [
                        'first' => $firstname,
                        'last' => $lastname,
                    ]
                );
            });

        return ($artist) ? $artist->id :  0;
    }

    private function findEventId($year): int
    {
        return Event::where('year_of', $year)->first()->id;
    }

    private function findSimilarTitles($title): Composition
    {
        $c = Composition::where('title', $title)
            ->firstOr(function() use ($title){
                Composition::create(
                    [
                        'title' => $title
                    ]
                );
        });

        return $c ?: new Composition;
    }
}
