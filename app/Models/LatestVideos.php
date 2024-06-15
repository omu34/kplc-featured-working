<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatestVideos extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'file_path',
        'link',
        'views',
        'likes',
        'is_featured',
        'created_at',
        'updated_at',
    ];

    public function featuredItem()
    {
        return $this->morphOne(FeaturedItems::class, 'item');
    }
}
