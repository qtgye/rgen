<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'description',
        'video_link',
        'url',
        'image',
    ];

    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'video_link' => 'url',
        'url' => 'url',
    ];

    public static $plural = 'Partners';
}
