@if ( isset( $projects ) && count($projects) > 0 )

<!-- product-section -->
<section class="product-section align-c product-section-2">
    <div class="container">
        <h2 class="title">Completed Projects</h2>
        <p class="title-sub">
            <!-- Lorem ipsum dolor sit amet, consetetur sadipscing elitr diam nonumy<br>
            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. -->
        </p>
        <div class="row eqh mb30 fs-equalize-element gallery">
            
            @foreach ( $projects as $project )
            
            <!-- column -->
            <div class="col-md-4 gallery-item">
                <!-- product-box -->
                <div class="product-box product-box1">
                    <div class="img">
                        <!-- <span class="save-tag">SAVE 10%</span> -->
                        @if ( isset( $project->image ) )
                            <a href="javascript://void" target="_blank">
                                <img src="/uploads/{{ $project->image }}" alt="Prd image">
                            </a>
                        @endif                        
                        <!-- <div class="price">
                            <span class="vm-item">
                                <i class="old">$50.00</i>
                                <b>$40.00</b>
                            </span>
                        </div> -->
                    </div>
                    <div class="info">
                        <h3 class="hd"><a href="javascript://void" target="_blank">{{ $project->title }}</a></h3>
                        <!-- <p class="txt">Lorem ipsum dolor sit amet, consetetur sadipscing elitr</p>
                        <a href="http://themeforest.net/item/rgen-landing-pages/13244840?ref=R_GENESIS" target="_blank" class="btn btn-line dark btn-sm">More info</a> -->
                    </div>
                </div><!-- /.product-box -->
            </div><!-- /.column -->

            @endforeach
            

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.product-section

@endif