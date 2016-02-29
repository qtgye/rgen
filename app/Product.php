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
	];

	public static $plural = 'products';

	public function getCategoryAttribute ($value)
	{
		return explode(',', $value);
	}

	public function setCategoryAttribute ($category)
	{
		$this->attributes['category'] = implode(',', $category);
	}

	public function setInfoFileAttribute($file)
	{
		$uploaded = Media::upload($file);
		$this->attributes['info_file'] = $uploaded ? $uploaded->file_name : null;
	}

	public function getCategoriesText ()
	{
		$categories = array_map(function ($category)
		{
			switch ($category) {
				case 'residential-small' 		: return 'Residential (Small)';
				case 'residential-multifamily' 	: return 'Residential (Multi Family)';
				case 'commercial-default' 		: return 'Commercial';
				case 'commercial-other' 		: return 'Commercial (Other)';
				case 'industrial-default' 		: return 'Industrial';
				case 'commercial-other' 		: return 'Industrial (Other)';
			}
		}, $this->category);
		return $categories;
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
