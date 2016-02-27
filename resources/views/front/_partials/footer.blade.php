<!-- footer-section -->
<section class="footer-section footer-section-5" style="outline-offset: -3px;">
	<div class="container">
		@if ( isset($info['logo']) )
			<img src="/uploads/{{ $info['logo'] }}" alt="Company logo">
		@else
			<h4>{{ $info['site-title'] }}</h4>
		@endif
		

		<div class="social-links">
			<a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank"><i class="fa fa-facebook"></i></a>
			<a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank"><i class="fa fa-twitter"></i></a>
			<a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank"><i class="fa fa-google-plus"></i></a>
			<a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank"><i class="fa fa-youtube-play"></i></a>
			<a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank"><i class="fa fa-instagram"></i></a>	
		</div><!-- /.social-links -->
		<hr>
		<p>{{ $info['address'] }}</p>
		<p>{{ $info['contact-line'] }}</p>
		<hr>
		<p class="copyright">Copyright © 2013 Green Innovations. All rights reserved.</p>
		<!-- <p class="copyright">R.Gen - Landing page bundle © 2015</p> -->
	</div><!-- /.container -->
</section><!-- /.footer-section --></div>
<!-- /#page --> 

<!-- JavaScript --> 
<script src="{{ asset('front/minify/rgen_min.js') }}"></script>
<script async="" src="{{ asset('front/js/rgen.js') }}"></script>

<!-- Custom JS -->
<script src="/front/js/_build.js"></script>


</body></html>