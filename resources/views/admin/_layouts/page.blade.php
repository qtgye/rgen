@include('admin._partials.header')
@include('admin._partials.sidebar')

<!--main content start-->
<section id="main-content" class="container">
  <section class="wrapper">
  	
	<div class="row">
		<div class="col-lg-12">
			<!-- breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="/admin">Home</a></li>
				<li><a href="/admin/{{ $page }}">{{ $page_title }}</a></li>
				@if ( isset($subpage) )
				<li>{{ $subpage_title }}</li>
				@endif				
			</ol>
			<h3 class="page-header text-default">{{ $page_title }}</h3>			
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