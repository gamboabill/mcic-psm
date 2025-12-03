<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'dateStart' => 'date',
        'dateEnd' => 'date',
    ];

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'status',
        'dateStart',
        'dateEnd',
    ];
}
