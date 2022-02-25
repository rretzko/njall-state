<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artisttype extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    const ARRANGER = 1;
    const COMPOSER = 2;
    const LYRICIST = 3;
    const WORDSANDMUSIC = 4;

    public $table = 'artisttypes';

    public $orderable = [
        'id',
        'descr',
    ];

    public $filterable = [
        'id',
        'descr',
    ];

    protected $fillable = [
        'descr',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
