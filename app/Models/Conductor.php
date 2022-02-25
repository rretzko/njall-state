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
