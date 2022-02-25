<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programlist extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'programlists';

    public $filterable = [
        'id',
        'composition.title',
        'order_by',
    ];

    public $orderable = [
        'id',
        'composition.title',
        'order_by',
        'opener',
        'closer',
    ];

    protected $casts = [
        'opener' => 'boolean',
        'closer' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'composition_id',
        'order_by',
        'opener',
        'closer',
    ];

    public function composition()
    {
        return $this->belongsTo(Composition::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
