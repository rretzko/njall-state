<?php

namespace App\Models;

use App\Models\Artist;
use App\Models\Artisttype;
use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

class Composition extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'compositions';

    public $orderable = [
        'id',
        'title',
        'subtitle',
    ];

    public $filterable = [
        'id',
        'title',
        'subtitle',
    ];

    protected $fillable = [
        'title',
        'subtitle',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function arrangers()
    {
        return $this->belongsToMany(Artist::class)
            ->wherePivot('artisttype_id', Artisttype::ARRANGER);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class)
            ->withPivot('artisttype_id');
    }

    public function composers()
    {
        return $this->belongsToMany(Artist::class)
            ->wherePivot('artisttype_id', Artisttype::COMPOSER);
    }

    /**
     * Return simple array of all associated artist names
     * @return string
     */
    public function getArtistBlockAttribute(): array
    {
        $a = [];
        foreach($this->artists AS $artist){

            $a[] = $artist->fullname;
        }

        return $a;
    }

    public function getPerformanceCountAttribute(): int
    {
        return $this->events()->count();
    }

    public function getPerformanceYearsCsvAttribute(): string
    {
        $a = [];

        foreach ($this->events as $event) {
            if($event) {
                $link = '\guest\event\\'.$event->id;
                $a[] = '<a href="'.$link.'" style="color: blue;">'
                    . $event->year_of
                    . '</a>';
            }
        }

        return implode(',',$a);
    }

    public function getWordsandmusicAttribute()
    {
        return $this->belongsToMany(Artist::class)
            ->wherePivot('artisttype_id', Artisttype::WORDSANDMUSIC);
    }

    public function lyricists()
    {
        return $this->belongsToMany(Artist::class)
            ->wherePivot('artisttype_id', Artisttype::LYRICIST);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

   public function events()
    {
        return $this->belongsToMany(Event::class)
            ->withPivot(['opener','closer','combined','order_by'])
            ->orderBy('event_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
