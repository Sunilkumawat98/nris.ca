@extends('layouts.main')

@php
    $page_name = 'Gif Ads';
    $routeUrl = 'gif_advertisement';
    $permission = 'gif_advertisement';
@endphp


@section('title', 'Nris Dashboard | {{ $page_name }}')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name}}</h1>

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

    <!-- Main content -->
          
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show {{ $page_name }}</h3>
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
                           Title : {{ $results->ad_name }}
                        </p>
                        
               
                        
                        <p>
                           Country : {{ ($results->country_id) ? getCountryNamebyId($results->country_id)->name : 'NA' }}
                        </p>
                        
                        <p>
                           State : {{ ($results->state_id) ? getStateNamebyId($results->state_id)->name : 'NA' }}
                        </p>

                        <p>
                           Amount : {{ $results->amount }}
                        </p>
                        <p>
                           Position : {{ $results->ad_position }}
                        </p>
                        
                        <p>
                           Start Date : {{ $results->start_date }}
                        </p>
                        <p>
                           End Date : {{ $results->end_date }}
                        </p>
                        <p>
                           click Url : {{ $results->click_url }}
                        </p>
                        <p>
                           Live : {{ $results->is_live ? 'Live' : 'Pause' }}
                        </p>
                        

                      
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="position-relative">
                        
                        <img src="{{ $results->image }}" alt="{{ $results->ad_name }}" class="img-fluid">
                        
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