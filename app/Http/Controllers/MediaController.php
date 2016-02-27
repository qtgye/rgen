<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::orderBy('created_at','DESC')->get();

        dd($media);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $post_max = (integer) trim(ini_get('post_max_size'),'M');
        $upload_max =  (integer) trim(ini_get('upload_max_filesize'),'M');
        $upload_limit = $post_max < $upload_max ? $post_max : $upload_max;
        // size in MB
        $upload_limit *= 1048576;

        if ( $request->ajax() ) {

            $response = [
                'success' => false,
                'data' => null
            ];

            $file = $request->file('file');

            // Check file size
            if ( $file->getSize() > $upload_limit || !$file->isValid() ) {
                $response = array_merge($response, [
                    'data' => [
                        'message' => 'The file is too large or is not valid. Please select another file.'
                    ],
                ]);
                return $response;
            }        

            // upload file and save to db
            $input = $request->all();
            $media = Media::upload($input['file'],$input);

            if ( !is_null($media) ) {
                $response = array_merge($response, [
                    'success' => true,
                    'data' => $media->toArray(),                    
                ]);
            }

            return $response;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        $response = [
            'success' => false,
            'data'  => [
                'message' => 'The requested item does not exist.'
            ]
        ];

        if ( $media ) {

            // delete file first
            if ( unlink( public_path() . '/uploads/' . $media->file_name ) ) {
                if ( $media->delete() ) {
                $response = array_merge($response,[
                                'success' => true,
                                'data' => [
                                    'message' => 'Successfully deleted item.'
                                ]
                            ]);
                }

            }
            
        }        

        return $response;
    }

}
