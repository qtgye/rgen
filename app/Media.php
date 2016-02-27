<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	protected $fillable = [
		'file_name',
		'file_type',
		'title',
		'description',
		'size',
		'meta1',
		'meta2',
		'meta3'
	];

	protected $rules = [
		'file_name' => 'required'
	];

	public static $plural = 'Media';

	public function scopeImage($query)
	{
		return $query->where('file_type','image');
	}

	public function scopePdf ($query)
	{
		return $query->where('file_type','pdf');
	}

	public function products ()
	{
		return $this->hasMany('\App\Product');
	}
	

	public static function upload($file, $meta = [])
	{
		$uploads_dir = public_path() . '/uploads';
		$uploaded = null;		
		$original_file_name = $file->getClientOriginalName();
		$size = $file->getSize();	
		$unique = md5($original_file_name . time());
		$file_name = $unique . '_' . $original_file_name;

		if ( $file->move($uploads_dir,$file_name) ) {

			$meta['title'] = !empty($meta['title']) ? $meta['title'] : $original_file_name;
			$data = compact('file_name','file_type','size');
			$data = array_merge($data,$meta);

			$uploaded = static::create($data);
		}

		return !is_null( $uploaded ) ? $uploaded : null;

	}
}
