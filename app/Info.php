<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = [
        'name',
        'value_type',
        'value'
    ];

    public static $rules = [
        'site-title' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'logo' => 'required',
        'favicon' => 'required',
        'description' => 'required'
    ];

    protected $table = 'info';

    public static $plural = 'Infos';

}
