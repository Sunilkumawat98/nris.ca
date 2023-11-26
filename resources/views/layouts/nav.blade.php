<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
      <img src="{{ URL::asset('dist/img/logo_head.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width= "163px;">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(auth()->user()->hasPermission('manage_dashboard'))
          <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          @endif
  
          
            @if(auth()->user()->hasPermission('manage_location'))
              <!-- <li class="nav-item menu-open"> -->
              <li class="nav-item {{ request()->is('country') || request()->is('state') || request()->is('city') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('country') || request()->is('state') || request()->is('city') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-flag"></i>
                  <p>
                    Location
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('country.index') }}" class="nav-link {{ request()->is('country') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Country</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('state.index') }}" class="nav-link {{ request()->is('state') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>State</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('city.index') }}" class="nav-link {{ request()->is('city') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>City</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
          
         
            @if(auth()->user()->hasPermission('manage_users'))
              <li class="nav-item {{ request()->is('admin_user') || request()->is('role') || request()->is('permission') || request()->is('permission_role') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('admin_user') || request()->is('role') || request()->is('permission') || request()->is('permission_role') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Administration
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin_user.index') }}" class="nav-link {{ request()->is('admin_user') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Users</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('role') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Role</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('permission.index') }}" class="nav-link {{ request()->is('permission') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Permission</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('permission_role.index') }}" class="nav-link {{ request()->is('permission_role') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Role Permission</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
            @endif
         
            @if(auth()->user()->hasPermission('manage_free_classifieds'))
              <li class="nav-item {{ request()->is('classified_category') || request()->is('classified_category/*') || request()->is('classified_sub_category') || request()->is('classified_sub_category/*') || request()->is('classified_sub_sub_category') || request()->is('classified_sub_sub_category/*') || request()->is('free_classified') || request()->is('free_classified/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('classified_category') || request()->is('classified_category/*') || request()->is('classified_sub_category') || request()->is('classified_sub_category/*') || request()->is('classified_sub_sub_category') || request()->is('classified_sub_sub_category/*') ||  request()->is('free_classified') || request()->is('free_classified/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-info"></i>
                  <p>
                    Free classified
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('classified_category.index') }}" class="nav-link {{ request()->is('classified_category') || request()->is('classified_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('classified_sub_category.index') }}" class="nav-link {{ request()->is('classified_sub_category') || request()->is('classified_sub_category/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>

                  
                  <li class="nav-item">
                    <a href="{{ route('classified_sub_sub_category.index') }}" class="nav-link {{ request()->is('classified_sub_sub_category') || request()->is('classified_sub_sub_category/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sub Sub Category</p>
                    </a>
                  </li>                  
                  
                  <li class="nav-item">
                    <a href="{{ route('free_classified.index') }}" class="nav-link {{ request()->is('free_classified') || request()->is('free_classified/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Free Classified</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

            @if(auth()->user()->hasPermission('manage_movie_ratings'))
              <li class="nav-item {{ request()->is('rating_source') || request()->is('rating_source/*') || request()->is('movie_rating') || request()->is('movie_rating/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('rating_source') || request()->is('rating_source/*') || request()->is('movie_rating') || request()->is('movie_rating/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tree"></i>
                  <p>
                    Movie Rating 
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('rating_source.index') }}" class="nav-link {{ request()->is('rating_source') || request()->is('rating_source/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Source</p>
                    </a>
                  </li>                  
                  <li class="nav-item">
                    <a href="{{ route('movie_rating.index') }}" class="nav-link {{ request()->is('movie_rating') || request()->is('movie_rating/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ratings</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

            @if(auth()->user()->hasPermission('manage_desi_movies'))
              <li class="nav-item {{ request()->is('desi_movies') || request()->is('desi_movies/*') ? 'menu-open' : '' }}">
                <a href="{{ route('desi_movies.index') }}" class="nav-link {{ request()->is('desi_movies') || request()->is('desi_movies/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-video"></i>
                  <p>
                    Desi Movies
                  </p>
                </a>
              </li>
            @endif

            @if(auth()->user()->hasPermission('manage_nris_talk'))
              <li class="nav-item {{ request()->is('nris_talk') || request()->is('nris_talk/*') ? 'menu-open' : '' }}">
                <a href="{{ route('nris_talk.index') }}" class="nav-link {{ request()->is('nris_talk') || request()->is('nris_talk/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Nris Talk
                  </p>
                </a>
              </li>
            @endif

            <!-- manage_business_listing -->

            @if(auth()->user()->hasPermission('manage_business_listing'))
              <li class="nav-item {{ request()->is('business_category') || request()->is('business_category/*') || request()->is('business_sub_category') || request()->is('business_sub_category/*') || request()->is('business_listing') || request()->is('business_listing/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('business_category') || request()->is('business_category/*') || request()->is('business_sub_category') || request()->is('business_sub_category/*') ||  request()->is('business_listing') || request()->is('business_listing/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>
                    Business Listing
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('business_category.index') }}" class="nav-link {{ request()->is('business_category') || request()->is('business_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('business_sub_category.index') }}" class="nav-link {{ request()->is('business_sub_category') || request()->is('business_sub_category/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('business_listing.index') }}" class="nav-link {{ request()->is('business_listing') || request()->is('business_listing/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Business Listing</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

            

            <!-- manage_national_events -->

            @if(auth()->user()->hasPermission('manage_national_event'))
              <li class="nav-item {{ request()->is('events_category') || request()->is('events_category/*')  || request()->is('national_events') || request()->is('national_events/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('events_category') || request()->is('events_category/*') ||  request()->is('national_events') || request()->is('national_events/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    National Events
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('events_category.index') }}" class="nav-link {{ request()->is('events_category') || request()->is('events_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('national_events.index') }}" class="nav-link {{ request()->is('national_events') || request()->is('national_events/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Events Listing</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif


            @if(auth()->user()->hasPermission('manage_student_talk'))
              <li class="nav-item {{ request()->is('student_talk_category') || request()->is('student_talk_category/*') || request()->is('university') || request()->is('university/*') || request()->is('student_talk') || request()->is('student_talk/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('student_talk_category') || request()->is('student_talk_category/*') || request()->is('university') || request()->is('university/*') ||  request()->is('student_talk') || request()->is('student_talk/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Student talk
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('student_talk_category.index') }}" class="nav-link {{ request()->is('student_talk_category') || request()->is('student_talk_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('university.index') }}" class="nav-link {{ request()->is('university') || request()->is('university/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>University Listing</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('student_talk.index') }}" class="nav-link {{ request()->is('student_talk') || request()->is('student_talk/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Studnet talk Listing</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
          
            
            @if(auth()->user()->hasPermission('manage_training_placement'))
              <li class="nav-item {{ request()->is('training_placement_category') || request()->is('training_placement_category/*') || request()->is('training_placement') || request()->is('training_placement/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('training_placement_category') || request()->is('training_placement_category/*') || request()->is('training_placement') || request()->is('training_placement/*')  ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Tranning & Placement
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('training_placement_category.index') }}" class="nav-link {{ request()->is('training_placement_category') || request()->is('training_placement_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('training_placement.index') }}" class="nav-link {{ request()->is('training_placement') || request()->is('training_placement/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tranning & Placement Listing</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif


            @if(auth()->user()->hasPermission('manage_blog'))
              <li class="nav-item {{ request()->is('blog_category') || request()->is('blog_category/*') || request()->is('blog') || request()->is('blog/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('blog_category') || request()->is('blog_category/*') || request()->is('blog') || request()->is('blog/*')  ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Blogs
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('blog_category.index') }}" class="nav-link {{ request()->is('blog_category') || request()->is('blog_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('blog.index') }}" class="nav-link {{ request()->is('blog') || request()->is('blog/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Blog</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

            
            @if(auth()->user()->hasPermission('manage_news_letter'))
              <li class="nav-item {{ request()->is('news_letter') || request()->is('news_letter/*') ? 'menu-open' : '' }}">
                <a href="{{ route('news_letter.index') }}" class="nav-link {{ request()->is('news_letter') || request()->is('news_letter/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    News Letter
                  </p>
                </a>
              </li>
            @endif
            
            @if(auth()->user()->hasPermission('manage_advertise'))
              <li class="nav-item {{ request()->is('advertise_with_us') || request()->is('advertise_with_us/*') ? 'menu-open' : '' }}">
                <a href="{{ route('advertise_with_us.index') }}" class="nav-link {{ request()->is('advertise_with_us') || request()->is('advertise_with_us/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Advertise With us
                  </p>
                </a>
              </li>
            @endif

            @if(auth()->user()->hasPermission('manage_gif_advertisement'))
              <li class="nav-item {{ request()->is('gif_advertisement') || request()->is('gif_advertisement/*') ? 'menu-open' : '' }}">
                <a href="{{ route('gif_advertisement.index') }}" class="nav-link {{ request()->is('gif_advertisement') || request()->is('gif_advertisement/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>
                    Advertise With us
                  </p>
                </a>
              </li>
            @endif







            @if(auth()->user()->hasPermission('manage_forum'))
              <li class="nav-item {{ request()->is('forum_category') || request()->is('forum_category/*') || request()->is('forum_sub_category') || request()->is('forum_sub_category/*') || request()->is('forum') || request()->is('forum/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('forum_category') || request()->is('forum_category/*') || request()->is('forum_sub_category') || request()->is('forum_sub_category/*') ||  request()->is('forum') || request()->is('forum/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-info"></i>
                  <p>
                    Forum
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('forum_category.index') }}" class="nav-link {{ request()->is('forum_category') || request()->is('forum_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('forum_sub_category.index') }}" class="nav-link {{ request()->is('forum_sub_category') || request()->is('forum_sub_category/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('forum.index') }}" class="nav-link {{ request()->is('forum') || request()->is('forum/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forum</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif






            @if(auth()->user()->hasPermission('manage_movie_videos'))
              <li class="nav-item {{ request()->is('movie_video_category') || request()->is('movie_video_category/*') || request()->is('movie_videos_language') || request()->is('movie_videos_language/*') || request()->is('movie_video') || request()->is('movie_video/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('movie_video_category') || request()->is('movie_video_category/*') || request()->is('movie_videos_language') || request()->is('movie_videos_language/*') ||  request()->is('movie_video') || request()->is('movie_video/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-info"></i>
                  <p>
                    Movie Videos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('movie_video_category.index') }}" class="nav-link {{ request()->is('movie_video_category') || request()->is('movie_video_category/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('movie_videos_language.index') }}" class="nav-link {{ request()->is('movie_videos_language') || request()->is('movie_videos_language/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Language</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('movie_video.index') }}" class="nav-link {{ request()->is('movie_video') || request()->is('movie_video/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Movie Videos</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>