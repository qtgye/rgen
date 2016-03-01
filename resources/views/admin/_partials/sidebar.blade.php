<!-- sidebar start-->
  <aside class="col-md-2 clearfix">
      <div id="sidebar"  class="n">
          <!-- sidebar menu start-->

          <!-- CONTROLLER PAGES -->
          
          @if ( $resourced_models )

            <ul class="sidebar-nav">     

              <li class="sidebar-item {{ ( $page == 'info' ? 'active' : '' ) }}">
                  <a class="sidebar-link" href="/admin/info" class="">
                      <!-- <i class="icon_document_alt"></i> -->
                      <span>Site Info</span>
                  </a>
              </li>       

              @foreach ( $resourced_models as $model_name => $title)
                <li class="sidebar-item {{ ( $page == $model_name ? 'active' : '' ) }}">
                    <a class="sidebar-link" href="/admin/{{$model_name}}">
                        <!-- <i class="icon_document_alt"></i> -->
                        <span>{{ $title }}</span>
                    </a>
                    <a class="animated-cross" href="/admin/{{$model_name}}/new" class="animated-cross"></a>
                    <!-- <ul class="sub">
                      <li class="{{ !isset($method) ? 'active' : '' }}"><a class="" href="/admin/{{$model_name}}">All</a></li>
                      <li class="{{ isset($subpage) && $page == $model_name ? 'active' : '' }}"><a class="" href="/admin/{{$model_name}}/new">New</a></li>
                    </ul> -->
                </li>              
              @endforeach
              
           </ul>

          @endif
          
          <!-- sidebar menu end-->
      </div>
  </aside>
  <!--sidebar end