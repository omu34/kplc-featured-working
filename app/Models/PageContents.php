<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContents extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'media',
        'subPage_id',
    ];

    public function subPages()
    {
        return $this->belongsTo(SubPages::class);
    }
}