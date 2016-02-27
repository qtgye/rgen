<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller
{
	public static $data = [
        'resourced_models' => [            
            'project' => 'Projects',
            'product' => 'Products',
            'partner' => 'Partners',
            'news'  => 'News',
            'faq' => 'FAQs',
            'media' => 'Media',
        ],
        'has_image_modal' => false,
        'site_info' => []
    ];

    public function __construct ()
    {
        \App\Info::all()->each(function ( $item, $key )
        {
            self::$data['site_info'][$item->name] = $item->value;
        });
    }

    /**
     * Controls the home page of the admin
     * @return view
     */
    public function home()
    {
    	self::$data['page_title'] = 'Welcome';
    	self::$data['page'] = 'index';

    	return view('admin.index',self::$data);
    }

    /**
     * Controls the lists page of the admin
     * @param  string $model_name = from route '/admin/{model_name}'
     * @return view 
     */
    public function index($model_name)
    {
    	if ( array_key_exists($model_name, self::$data['resourced_models']) ) {

            $model = '\\App\\' . ucfirst($model_name);

    		self::update_page_data($model_name);                        
            self::$data['page_title'] = ucfirst($model::$plural);
            self::$data['items'] = $model::latest()->get();
            self::$data['model_plural'] = $model::$plural;

    		return view('admin.all',self::$data);

    	}

    	return redirect('/admin');
    }

    /**
     * Controls the 'admin/create' route
     * @param  Strting $model_name the model name from route '/admin/{model_name}'
     * @return view             The create page
     */
    public function create($model_name)
    {
    	if ( array_key_exists($model_name, self::$data['resourced_models']) ) {

            $model = '\\App\\' . ucfirst($model_name);
            self::update_page_data($model_name);
            self::$data['model_plural'] = $model::$plural;
            self::$data['subpage'] = 'create';
            self::$data['subpage_title'] = 'New';
            self::$data['submit_text'] = $model_name !== 'media' ? 'Create' : null;

    		return view('admin.create',self::$data);
    	}

    	return redirect('/admin');
    }

    public function update ($model_name,$id, Request $request)
    {
        if ( array_key_exists($model_name, self::$data['resourced_models']) ) {

            $model = '\\App\\' . ucfirst($model_name);
            $res = call_user_func( [$model,'find'], $id );
            $res->update($request->all());
            $res->save();

            return redirect('/admin/' . $model_name . '/' . $id);
        }

        return redirect('/admin');
    }

    public function show($model_name,$id)
    {
        if ( array_key_exists($model_name, self::$data['resourced_models']) || $model_name == 'media' ) {

            $model = '\\App\\' . ucfirst($model_name);
            self::update_page_data($model_name);
            self::$data['model_plural'] = $model::$plural;
            self::$data['subpage'] = 'create';
            self::$data['subpage_title'] = 'New';
            self::$data['submit_text'] = 'Save';
            self::$data[$model_name] = call_user_func( [$model,'find'], $id );

            if ( self::$data[$model_name] ) {
                return view('admin.edit',self::$data);
            } 

            return redirect('/admin/' . $model_name);
        }

        return redirect('/admin');
    }

    public function info ()
    {
        $infos = [];

        \App\Info::all()->each(function ($item) use ( &$infos )
        {
            $infos[ $item->name ] = $item->value;
        });

        $model = '\App\Info';
        self::update_page_data('info');

        $data = array_merge( self::$data, [
            'model_plural' => $model::$plural,
            'submit_text' => 'Save',
            'infos' => $infos,
        ]);

        return view('admin.edit',$data);
    }

    public function get_upload_limit(Request $request)
    {
        $response = [
            'success' => false,
            'data' => []
        ];

        $post_max_size = (integer) trim(ini_get('post_max_size'),'M');
        $upload_max_filesize =  (integer) trim(ini_get('upload_max_filesize'),'M');
        // size in MB
        $post_max_size *= 1048576;
        $upload_max_filesize *= 1048576;

        return array_merge( $response, [
                    'success' => true,
                    'data' => compact( 'post_max_size',  'upload_max_filesize')
                ]);
    }

    /**
     * Updates the view variables that are frequently used in an admin page
     * @param  string $model_name = the model name from route 'admin/{model_naem}'
     * @return void            
     */
    public static function update_page_data($model_name = '')
    {
        self::$data['page_title'] = ucfirst($model_name);
        self::$data['page'] = $model_name;        
        self::$data['model_name'] = $model_name;
        self::$data['controller_name'] = self::$data['model_name'] . 'sController';

        // get images for particular models
        if ( preg_match('/(product|partner|project|info)/i', $model_name ) ) {
            self::$data['images'] = \App\Media::image()->latest()->get();
            self::$data['has_image_modal'] = true;
        }
    }
}
