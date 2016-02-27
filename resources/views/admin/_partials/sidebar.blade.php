<!-- sidebar start-->
  <aside>
      <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->

          <!-- CONTROLLER PAGES -->
          
          @if ( $resourced_models )

            <ul class="sidebar-menu">     

              <li class="sub-menu {{ ( $page == 'info' ? 'active' : '' ) }}">
                  <a href="/admin/info" class="">
                      <!-- <i class="icon_document_alt"></i> -->
                      <span>Site Info</span>
                  </a>
              </li>       

              @foreach ( $resourced_models as $model_name => $title)
                <li class="sub-menu {{ ( $page == $model_name ? 'active' : '' ) }}">
                    <a href="javascript:;" class="">
                        <!-- <i class="icon_document_alt"></i> -->
                        <span>{{ $title }}</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                      <li class="{{ !isset($method) ? 'active' : '' }}"><a class="" href="/admin/{{$model_name}}">All</a></li>
                      <li class="{{ isset($subpage) && $page == $model_name ? 'active' : '' }}"><a class="" href="/admin/{{$model_name}}/new">New</a></li>
                    </ul>
                </li>              
              @endforeach
              
           </ul>

          @endif
          
          <!-- sidebar menu end-->
      </div>
  </aside>
  <!--sidebar end