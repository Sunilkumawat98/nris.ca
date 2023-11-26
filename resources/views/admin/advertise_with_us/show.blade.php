@extends('layouts.main')

@section('title', 'Nris Dashboard | Advertise With Us')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advertise With Us</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Advertise With Us</li>
            </ol>
            

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
          
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show Advertise With Us</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <div class="post">
                        <div class="user-block">
                          <span class="description">{{ $results->created_at }}</span>
                        </div>
                        
                        <p>
                           Name : {{ $results->first_name  }} {{ $results->last_name  }}
                        </p>
                        
                        <p>
                           Email : {{ $results->email }}
                        </p>
                        
                        <p>
                           Phone : {{ $results->phone }}
                        </p>
                        <p>
                           Business : {{ $results->business }}
                        </p>
                        <p>
                           Website : {{ $results->website }}
                        </p>
                        <p>
                           Message : {{ $results->mesage }}
                        </p>
                        
                        
                        <p>
                           Live : {{ $results->is_live ? 'Live' : 'Pause' }}
                        </p>
                        
                        
                      
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="position-relative">
                        {{-- <img src="../../dist/img/photo1.png" alt="Photo 1" class="img-fluid"> --}}
                        <img src="{{ $results->image }}" alt="{{ $results->first_name }}" class="img-fluid">
                        
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
              
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