<!-- Call to action-section -->
<section class="calltoaction-section calltoaction-section-1">
    <div class="container">
        <div class="row">
            
            @if ( isset( $info['about-video'] ) )
                <div class="col-md-6 pull-left">
                    <div class="video-box">
                        <iframe width="435" height="260" src="{{ $info['about-video'] }}" frameborder="0" allowfullscreen=""></iframe>
                    </div><!-- /.video-box -->
                </div>
            @endif
            
            <div class="{{ (isset($info['about-video']) ? 'col-md-6 pull-right' : '')  }}" style="height: 100%; position: absolute; top: 50%; transform: translateY(-50%); right: 0;">
                <h2 class="title medium" style="position: absolute; width: 100%; top: 50%; transform: translateY(-50%);">
                    Why Treat Wastewater?
                </h2>
            </div>


        </div>
        
    </div>
    <div class="full-wh bg-cover bg-cc" data-bg="/front/images/bg2.jpg" style="background-image: url(http://greenlemonmedia.com/projects/builder/elements/images/bg2.jpg); outline-offset: -3px;">
        <b class="full-wh"></b>
    </div>
</section><!-- /.calltoaction-section -->