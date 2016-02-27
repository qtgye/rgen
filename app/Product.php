<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\CreateProductRequest;
use App\Media;

class Product extends Model
{
    
	protected $fillable = [
		'name',
		'category',
		'type',
		'image',
		'description',
		'info_file'
	];

	public static $rules = [
		'name' => 'required',
		'category' => 'required',
		'type' => 'required',
	];

	public static $plural = 'products';

	public function setInfoFileAttribute($file)
	{
		$uploaded = Media::upload($file);
		$this->attributes['info_file'] = $uploaded ? $uploaded->file_name : null;
	}

	public function getInfoFileAttribute($filename)
	{
		if ( $filename ) {
			$file = \App\Media::where('file_name',$filename)->first();
			return $file->title;
		}		
	}

	public function file ()
	{
		return $this->hasOne('App\Media','file_name','info_file');
	}

	public function image ()
	{
		return $this->hasOne('App\Media','file_name','image');
	}

}
