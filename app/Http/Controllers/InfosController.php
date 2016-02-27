<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\Info;

class InfosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {
        
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
    public function update(Requests\InfoRequest $request)
    {   

        foreach ($request->all() as $key => $value) {

            if (  !array_key_exists($key, Info::$rules ) ) continue;

            if ( $info = Info::where('name',$key)->first() ) {
                // update if existing and different
                if ( $info->value !== $value ) {
                    $info->update([
                        'value' => $value
                    ]);
                }
            } else {
                // new entry
                Info::create([
                    'name' => $key,
                    'value' => $value
                ]);
            }           

        }

        return redirect('/admin/info')->with('success','Succesfully updated information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Info::find($id);

        $response = [
            'success' => false,
            'data'  => [
                'message' => 'The requested item does not exist.'
            ]
        ];

        if ( $info ) {

            if ( $info->delete() ) {
            $response = array_merge($response,[
                            'success' => true,
                            'data' => [
                                'message' => 'Successfully deleted item.'
                            ]
                        ]);
            }
            
        }        

        return $response;
    }
}
