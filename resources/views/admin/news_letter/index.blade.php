@extends('layouts.main')

@php
    $page_name = 'Subscribe News letter';
    $routeUrl = 'news_letter';
    $permission = 'news_letter';
@endphp

@section('title', 'Nris Dashboard | {{ $page_name }}')
<style>
    
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d12323;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #4CAF50; /* Green for "live" */
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }} page</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">{{ $page_name }}</li>
              </ol>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Search Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- <h2 class="text-center display-4">Search</h2> -->
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ route($routeUrl.'.index') }}" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-lg" placeholder="Search by email..." name="search" value="{{ $searchQuery }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <!-- Search Main content -->
    
    
    

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif
            <div class="card">
                
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Live</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                        $i = 1;
                      @endphp

                      @foreach($results as $result)
                      <tr>
                        
                        <td>{{ $result->email }} </td>
                        
                        <td>
                          
                          <form action="{{ route($routeUrl.'.activeStatus', $result->id) }}" method="POST">
                              @csrf
                              <label class="switch">
                                  <input type="checkbox" onchange="this.form.submit()" {{ $result->is_live === 1 ? 'checked' : '' }}>
                                  <span class="slider round"></span>
                              </label>
                          </form>

                        </td>
                        <td>{{ $result->created_at }}</td>
                        
                      </tr>
                      @php
                          $i++;
                      @endphp
                      @endforeach                
                      
                      
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @if ($previousPage)
                        <li class="page-item">
                            <a class="page-link" href="?page={{ $previousPage }}">&laquo;</a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $results->lastPage(); $i++)
                        <li class=" page-item {{ $i == $results->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Forward button --}}
                    @if ($nextPage)
                        <li class="page-item">
                            <a class="page-link" href="?page={{ $nextPage }}">&raquo;</a>
                        </li>
                    @endif
                </ul>

                
              </div>
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          
        </div>
        
        
        
        








      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection