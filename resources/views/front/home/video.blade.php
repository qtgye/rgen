<!-- Video section -->
<section class="video-section video-section-2">
    <div class="container">
        
        <div class="row eqh">
            <div class="col-md-5 col-md-push-7">
                <div class="content vm-item">
                    <h2 class="title">Take quick overview of features</h2>
                    <p class="title-sub">
                        Lorem ipsum dolor sit amet, consetetur sadipscing<br>elitr diam nonumyeirmod tempor invidunt ut labore etdolore.
                    </p>            
                </div>
            </div>
            @if ( isset( $info['video'] ) )
                <div class="col-md-6 col-md-offset-1 col-md-pull-6">
                    <div class="video-box">
                        <iframe width="100%" height="100%" src="{{ $info['video'] }}" frameborder="0" allowfullscreen=""></iframe>
                        
                    </div><!-- /.video-box -->
                </div>
            @endif
            
        </div>
    </div>
    <div class="full-wh bg-section bg-cover" data-blurimg="images/bg4.jpg"><b class="full-wh"></b></div>
</section><!-- /.video-section -->