<!DOCTYPE html>
<html><head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ isset($page_title) ? $page_title . ' | ' : '' }} {{ $info['site-title'] }}</title>
	<meta name="description" content="{{ $info['description'] }}">
	<meta name="keywords" content="">

	<!--pageMeta-->

	<!-- Lib CSS -->
	<link href="//fonts.googleapis.com/css?family=Rancho|Open+Sans:400,300,300italic,400italic,600,600italic,700,800italic,700italic,800" rel="stylesheet">
	<link href="{{ asset('front/minify/rgen_min.css') }}" rel="stylesheet">
	<link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="/front/css/_build.css">

	<!-- Favicons -->
	<link rel="icon" href="/uploads/{{ $info['favicon'] }}">
	<link rel="apple-touch-icon" href="/uploads/{{ $info['favicon'] }}">
	<link rel="apple-touch-icon" sizes="72x72" href="/uploads/{{ $info['favicon'] }}">
	<link rel="apple-touch-icon" sizes="114x114" href="/uploads/{{ $info['favicon'] }}">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--[if IE 9 ]><script src="js/ie-matchmedia.js"></script><![endif]-->

</head>
<body>
<div id="page">