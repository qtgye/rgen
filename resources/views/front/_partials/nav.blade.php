<!-- Navigation -->
<!-- /.nav-wrp --><!-- Call to action-section -->
<!-- /.calltoaction-section --><!-- Testimonials -->
<!-- /.testimonial-section --><!-- Navigation -->
<!-- /.nav-wrp --><!-- Call to action-section -->
<!-- /.calltoaction-section --><!-- product-section -->
<!-- /.product-section --><!-- Navigation -->
<!-- /.nav-wrp --><!-- Call to action-section -->
<!-- /.calltoaction-section --><!-- Features -->
<!-- /.feature-section --><!-- Navigation -->
<nav class="nav-wrp nav-4">
	<div class="container">
		
		<div class="nav-header">
			<a class="navbar-brand" href="/">
				@if ( isset( $info['logo'] ) )
					<img src="/uploads/{{ $info['logo'] }}" alt="{{ $info['site-title'] }}">
				@else
					<h3>{{ $info['site-title'] }}</h3>
				@endif
			</a>
			<a class="nav-handle fs-touch-element" data-nav=".nav"><i class="fa fa-bars"></i></a>	
		</div>
		
		<div class="nav vm-item">
			<ul class="nav-links">
				<li><a href="/about">About</a></li>
				<li><a href="/services">Services</a></li>
				<li><a href="/technologies">Technologies</a></li>
				<li><a href="/projects">Projects</a></li>
				<li><a href="/news">News</a></li>
				<li><a href="javascript://void">Request A Quote</a></li>
			</ul>
			<div class="nav-other">
				<span><i class="fa fa-phone"></i> {{ $info['phone'] }}</span>
				<span><a href="mailto:{{ $info['email'] }}"><i class="fa fa-envelope-o"></i> Email us</a></span>
			</div>
		</div><!-- /.nav --> 
		
	</div><!-- /.container --> 
</nav><!-- /.nav-wrp -->