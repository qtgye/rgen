@include('admin._partials.header')
@include('admin._partials.sidebar')

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
  	
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">{{ $page_title }}</h3>
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="/admin">Home</a></li>
				<li><a href="/admin/{{ $page }}">{{ $page_title }}</a></li>
				@if ( isset($subpage) )
				<li>{{ $subpage_title }}</li>
				@endif				
			</ol>
		</div>
	</div>
	
	<!-- content -->
	<div class="row">		
		@yield('content')
	</div>
	

</section>
</section>
<!--main content end-->

@include('admin._partials.footer')