<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Info;

class PagesController extends Controller
{
    public static $data = [
        'info' => []
    ];

    public function __construct ()
    {
        Info::all()->each(function ( $item, $key )
        {
            self::$data['info'][$item->name] = $item->value;
        });
    }
    
	public function home()
	{	
        $data = array_merge(self::$data,[
            'partners' => \App\Partner::all(),
            'projects' => \App\Project::latest()->limit(3)->get()
        ]);

		return view('front.index', $data);
	}

    public function about()
    {
        $data = array_merge(self::$data,[
            'partners' => \App\Partner::all(),
        ]);
        return view('front.about', $data);
    }

    public function services ()
    {
        $data = array_merge(self::$data,[
            // 'projects' => \App\Project::all(),
        ]);
        return view('front.services', $data);
    }

    public function technologies ()
    {
        $data = array_merge(self::$data,[
            // 'projects' => \App\Project::all(),
        ]);
        return view('front.technologies', $data);
    }

    public function projects ()
    {
        $data = array_merge(self::$data,[
            'projects' => \App\Project::all(),
        ]);
        return view('front.projects', $data);
    }

    public function news ()
    {
        $data = array_merge(self::$data,[
            // 'projects' => \App\Project::all(),
        ]);
        return view('front.news', $data);
        
    }


}
