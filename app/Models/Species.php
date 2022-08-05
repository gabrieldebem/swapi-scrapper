<?php

namespace App\Models;

use App\Traits\PruneInSevenDays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory, PruneInSevenDays;

    protected $fillable = [
        'name',
        'classification',
        'designation',
        'average_height',
        'skin_colors',
        'eye_colors',
        'average_lifespan',
        'language',
    ];
}
