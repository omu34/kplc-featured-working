<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPages extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'media',
        'main_page_id',
    ];

    public function mainPage()
    {
        return $this->belongsTo(MainPages::class);
    }

    public function pageContents()
    {
        return $this->hasOne(PageContents::class);
    }
}