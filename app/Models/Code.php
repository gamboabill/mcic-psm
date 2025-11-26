<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Code extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $fillable = [
        'delete_code',
    ];
}
