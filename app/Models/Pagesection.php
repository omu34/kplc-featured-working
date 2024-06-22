<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagesection extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'media', 'page_id'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function pagecontents()
    {
        return $this->hasMany(Pagecontent::class);
    }
}
