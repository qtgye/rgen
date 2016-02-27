@extends('page')

@section('content')

	@foreach ([ 'slider', 'about-us', 'video', 'products' ] as $file)
		@include('front.home.'.$file)
	@endforeach

@stop