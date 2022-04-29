<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'artists';

    public $orderable = [
        'id',
        'first',
        'last',
    ];

    public $filterable = [
        'id',
        'first',
        'last',
        'artisttype.descr',
    ];

    protected $fillable = [
        'first',
        'last',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function artisttype()
    {
        return $this->belongsToMany(Artisttype::class);
    }

    public function artisttypeAbbr($artisttype_id)
    {
        return Artisttype::find($artisttype_id)->abbr;
    }

    public function artisttypeDescr($artisttype_id)
    {
        return Artisttype::find($artisttype_id)->descr;
    }

    public function compositions()
    {
        return $this->belongsToMany(Composition::class);
    }

    public function getFullnameAttribute()
    {
        return $this->first.' '.$this->last;
    }

    public function getFullnameAlphaAttribute()
    {
        return $this->last.', '.$this->first;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
