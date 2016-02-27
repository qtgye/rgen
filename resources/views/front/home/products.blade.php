product-section -->
<section class="product-section product-section-2 bg-gray">
    <div class="container">
        <h2 class="title align-c">Most Recent Projects</h2>
        <p class="title-sub align-c">
            
        </p>
        
        <!-- carousel-widget -->
        <div class="carousel-widget ctrl-2" id="carousel-widget" data-items="1" data-itemrange="false" data-autoplay="false" data-loop="true" data-margin="20" data-stpd="3" data-pager="true" data-nav="true">
            <div class="owl-carousel">

                @foreach ($projects as $project)
                    <!-- Item -->
                    <div class="item">
                        <!-- product-box2 -->
                        <div class="product-box2">
                            <!-- Image -->
                            @if ( $project['image'] )
                                <div class="img">
                                    <a href="javascript://void" target="_blank">
                                        <img src="/uploads/{{ $project->image }}" alt="{{ $project->title }}" title="{{ $project->title }}">
                                    </a>
                                </div>
                            @endif
                            <!-- Info -->
                            <div class="info">
                                <!-- <small class="tag-text">NEW YORK CITY</small> -->
                                <h2 class="hd">
                                    <a href="javascript://void" target="_blank">{{ $project->title }}</a>
                                </h2>
                                <!-- <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam...</p>
                                <hr class="mr-tb-20">
                                <div class="price-wrp">
                                    <div class="price"><small>From</small>$99.00</div>
                                    <a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank" class="btn btn-default">More info</a>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.product-box2 -->
                    </div><!-- /.Item -->
                @endforeach

            </div><!-- /.owl-carousel -->
        </div><!-- /.carousel-widget -->
    </div><!-- /.container -->
</section><!-- /.product-section