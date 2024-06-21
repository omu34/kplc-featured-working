<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPages extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'media',
    ];

    public function subPages()
    {
        return $this->hasMany(SubPages::class);
    }
}