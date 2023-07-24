@extends('layouts.main')

@section('title', 'Nris Dashboard | Country')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Country</li>
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
                    <h3 class="card-title">Show Country</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="post">
                        <div class="user-block">
                          <span class="description">{{ $country->created_at }}</span>
                        </div>
                        
                        <p>
                           Name : {{ $country->name }}
                        </p>
                        <p>
                           Color : {{ $country->color }}
                        </p>
                        <p>
                           Code : {{ $country->code }}
                        </p>
                        <p>
                           Domain : {{ $country->domain }}
                        </p>
                        <p>
                           Live : {{ $country->is_live ? 'Live' : 'Pause' }}
                        </p>
                        <p>
                           Meta Title : {{ $country->c_meta_title }}
                        </p>
                        <p>
                           Meta Description : {{ $country->c_meta_description }}
                        </p>
                        <p>
                           Meta Keyword : {{ $country->c_meta_keywords }}
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