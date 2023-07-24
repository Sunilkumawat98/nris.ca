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
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          @endif
  
          
            @if(auth()->user()->hasPermission('manage_location'))
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-flag"></i>
                  <p>
                    Location
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('country.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Country</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('state.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>State</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('city.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>City</p>
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