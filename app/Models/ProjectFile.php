<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
        'category',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
