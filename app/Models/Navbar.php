<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'name', 'link', 'column1', 'column2', 'navItem1', 'navItem', 'code', 'order'
    ];
}
