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

    public function participants()
    {
        return $this->belongsToMany(Participant::class)->orderBy('order_by');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
