<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediatype extends Model
{
    use HasFactory;

    protected $fillable=['descr'];

    const AUDIO = 1;
    const VIDEO = 2;

}
