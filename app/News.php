<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    public static $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    private $title;

    public static $plural = 'News';
}
