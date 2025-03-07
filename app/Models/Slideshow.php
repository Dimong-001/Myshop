<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    //
    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'link',
        'image',
        'order',
    ];
}
