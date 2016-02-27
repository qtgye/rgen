<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'image',
    ];

    public static $rules = [
        'title' => 'required',
        'image' => 'required',
    ];

    private $title;

    public static $plural = 'Projects';
}
