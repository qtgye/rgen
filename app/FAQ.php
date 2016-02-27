<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'category',
        'question',
        'answer',
    ];

    public static $rules = [
        'category' => 'required',
        'question' => 'required',
        'answer' => 'required',
    ];

    public static $plural = 'FAQs';
}
