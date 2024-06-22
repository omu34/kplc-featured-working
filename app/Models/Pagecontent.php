<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagecontent extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'media', 'pagesection_id'];

    public function pagesection()
    {
        return $this->belongsTo(Pagesection::class);
    }
}
