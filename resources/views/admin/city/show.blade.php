@extends('layouts.main')

@section('title', 'Nris Dashboard | City Show')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show City</h1>

            <?php 
              // echo "<pre>";
              // print_r(Auth::guard()->user());
              // echo "</pre>";
              // echo "<pre>";
              // print_r($country);
              // echo "</pre>";


            ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">City</li>
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
                    <h3 class="card-title">Show City</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="post">
                        <div class="user-block">
                          <span class="description">{{ $results->created_at }}</span>
                        </div>
                        
                        <p>
                           Name : {{ $results->name }}
                        </p>
                        <p>
                           Country : {{ getCountryNamebyId($results->country_id)->name }}
                        </p>
                        <p>
                           State : {{ getStateNamebyId($results->state_id)->name }}
                        </p>
                        <p>
                           State Code : {{ $results->state_code }}
                        </p>
                        <p>
                           Code : {{ $results->code }}
                        </p>
                       
                        <p>
                           Live : {{ $results->is_live ? 'Live' : 'Pause' }}
                        </p>
                        
                      
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