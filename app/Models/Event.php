<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'events';

    public $orderable = [
        'id',
        'name',
        'year_of',
    ];

    public $filterable = [
        'id',
        'name',
        'year_of',
    ];

    protected $fillable = [
        'name',
        'year_of',
        'program_link',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cancellation()
    {
        return $this->hasOne(Cancellation::class);
    }

    public function compositions()
    {
        return $this->belongsToMany(Composition::class)
            ->withPivot(['opener','closer','combined','order_by'])
            ->orderBy('order_by');
    }

    public function conductors()
    {
        return $this->belongsToMany(Conductor::class)->orderBy('name');
    }

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class)->orderBy('order_by');
    }

    public function getConductorsCsvAttribute()
    {
        $noconductor = 'No conductor found';

        $conductors = $this->conductors();
        //early exits
        if(! $conductors){ return $noconductor;}

        if(($conductors->count() === 1) &&
            $conductors->first()->id &&
            strlen($conductors->first()->name)){
            return $conductors->first()->name;
        }

        $a = [];
        foreach($conductors AS $conductor){

            if(! $conductor){ return $noconductor;}

            $a[] = $conductor->name;
        }

        return implode(';', $a);
    }

    public static function getCurrentEvent()
    {
        return Event::orderByDesc('year_of')->first();
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class)->orderBy('order_by');
    }

    public function schoolParticipantCount(School $school)
    {
        return $this->schoolParticipants($school)->count();
    }

    public function schoolParticipants(School $school)
    {
        return Participant::where('school_id', $school->id)
            ->where('event_id', $this->id)
            ->orderBy('last')
            ->orderBy('first')
            ->get();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
