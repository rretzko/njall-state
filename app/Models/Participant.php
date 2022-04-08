<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'participants';

    public $orderable = [
        'id',
        'first',
        'last',
        'instrumentation.descr',
        'school.name',
    ];

    public $filterable = [
        'id',
        'first',
        'last',
        'instrumentation.descr',
        'school.name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first',
        'last',
        'instrumentation_id',
        'school_id',
    ];

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * NOTE: This is an approximate function which relies on
     * the matching of first/last names and school_id
     */
    public function events()
    {
        $ids = \Illuminate\Support\Facades\DB::table('participants')
            ->where('school_id', $this->school_id)
            ->where('first', $this->first)
            ->where('last', $this->last)
            ->pluck('event_id')
            ->toArray();

        return Event::find($ids);
    }

    public function getFullnameAttribute()
    {
        return $this->first.' '.$this->last;
    }

    public function getFullnameAlphaAttribute()
    {
        return $this->last.', '.$this->first;
    }

    public function instrumentation()
    {
        return $this->belongsTo(Instrumentation::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function yearsCsv()
    {
        $a = [];
        foreach($this->events() AS $event){

            $a[] = '<a href="/guest/event/'.$event->id.'" style="color: blue;">'.$event->year_of.'</a>';
        }

        return implode(',', $a);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
