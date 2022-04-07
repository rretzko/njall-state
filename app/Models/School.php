<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'schools';

    public $orderable = [
        'id',
        'name',
        'city',
        'postal_code',
    ];

    public $filterable = [
        'id',
        'name',
        'city',
        'postal_code',
    ];

    protected $fillable = [
        'name',
        'city',
        'postal_code',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Return collection of schools by year or student counts in a direction (asc,desc)
     * @return \Illuminate\Support\Collection
     */
    public static function byColumn(\Illuminate\Http\Request $request)
    {
        $schools = [];
        $column = $request['column'];
        $direction = isset($request['direction']) ? $request['direction'] : 'asc';
        $pagination = 20;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $pagination) - $pagination;
        $path = $request->url();
        $query = $request->query();

        foreach(School::all() AS $school){

            $schools[] = [
                'sort' => DB::table('participants')->where('school_id', $school->id)->distinct('event_id')->count('event_id'),
                'name' => $school->name,
                'school' => $school,
            ];
        }

        sort($schools);

        $array = array_slice($schools, $starting_point, $pagination, true);

        return new Paginator($array, $pagination, $current_page, ['path' => $path,'query' => $query]);
    }

    public function getEventsAttribute()
    {
        $events = collect();

        foreach(Participant::where('school_id', $this->id)->pluck('event_id') AS $event_id){

            $events->push(Event::find($event_id));
        }

        return $events->unique()->sortBy('year_of');
    }

    public function getShortnameAttribute()
    {
        $shorts = [
            'regional high school' => 'RHS',
            'regional' => 'RHS',
            'high school' => 'HS',
            'township' => 'Twp',
        ];

        $shortname = $this->name;

        foreach($shorts AS $key => $short){

            $shortname = str_replace($key, $short, $shortname);
        }
//$shortname = str_replace('Township', 'Twp', $shortname);
        return $shortname;
    }

    public function getStudentsCountAttribute()
    {
        return DB::table('participants')
            ->where('school_id', $this->id)
            ->count('id');
    }

    public function getYearsAttribute()
    {
        $eventids = DB::table('participants')
            ->where('school_id', $this->id)
            ->distinct('event_id')
            ->pluck('event_id')
            ->toArray();

        return Event::find($eventids)->sortByDesc('year_of');
    }

    public function getYearsCountAttribute()
    {
        return DB::table('participants')
            ->where('school_id', $this->id)
            ->distinct('event_id')
            ->count('id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
