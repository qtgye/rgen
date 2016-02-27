<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminProductsController extends Controller
{
	public static $data = [];

	public function __construct()
	{
		self::$data['controller_pages'] = [
			'info' => 'Info',
			'products' => 'Products',
			'faqs' => 'FAQs',
			'news' => 'News',
		];
	}
    
	public function index()
	{
		self::$data['page_title'] = 'Welcome';
    	self::$data['current_page'] = 'index';
		return view('admin.all');
	}

	public function create()
	{
		return view('admin.create');
	}

}
