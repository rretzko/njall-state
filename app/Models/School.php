<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getEventsAttribute()
    {
        $events = collect();

        foreach(Participant::where('school_id', $this->id)->pluck('event_id') AS $event_id){

            $events->push(Event::find($event_id));
        }

        return $events->unique()->sortBy('year_of');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
