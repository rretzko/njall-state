<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'conductors';

    public $orderable = [
        'id',
        'name',
    ];

    public $filterable = [
        'id',
        'name',
    ];

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Conductor's first name is derived from all parts of conductor's full name
     * minus the first and last parts
     *
     * @return string
     */
    public function getFirstAttribute()
    {
        $first = '';
        $parts = explode(" ", $this->name);

        $honorific = array_shift($parts);
        $last = array_pop($parts);

        foreach($parts AS $part){

            $first .= $part.' ';
        }

        return trim($first);

    }

    /**
     * Conductor's full name is as printed in the program
     * Conductors name requires an:
     * - Honorific (Dr., Mr., Ms., etc)
     * - First name
     * - Last name
     * - all parts between the Honorific and Last name are considered First name
     * - no consideration has been given for name suffixes (Jr., Sr., III, etc.)
     * @return string
     */
    public function getFullnameAlphaAttribute()
    {
        //[title,firstname,middlename (opt),lastname];
        $parts = explode(" ", $this->name);

        $title = $parts[0];
        $first = $parts[1];
        $middle = (count($parts) === 4) ? $parts[2] : '';
        $last = $parts[(count($parts) - 1)];

        return $last.', '.$first.' '.$middle.' ('.$title.')';
    }

    public function getLastAttribute()
    {
        $parts = explode(" ", $this->name);

        return $parts[(count($parts) - 1)];
    }

    public function getYearsAttribute()
    {
        $years = [];

        foreach($this->events AS $event){

            if(! in_array($event->year_of, $years)){
                $years[] = $event->year_of;
            }
        }

        return implode(',', $years);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
