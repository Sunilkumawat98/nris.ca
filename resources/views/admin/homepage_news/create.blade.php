@extends('layouts.main')

@php
    $page_name = 'News Videos';
    $routeUrl = 'homepage_news';
    $permission = 'homepagenews';
@endphp

@section('title', 'Nris Dashboard | {{$page_name}} Add')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }}</h1>

            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">{{ $page_name }}</li>
              <li class="breadcrumb-item active">Create New</li>
       


            </ol>
            

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
          
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Add New {{ $page_name }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" action="{{ route($routeUrl.'.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="card-body">
                      
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                  <label for="name">Title</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title">
                                  </div>
                              </div>
                          </div>
                          <div class="row">    
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Video Link</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="video_link" name="video_link" value="{{ old('video_link') }}" placeholder="Enter video link">
                                    </div>
                                </div>
                            </div>
                              
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="Enter description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_title" name="meta_title" placeholder="Enter Meta title">{{ old('meta_title') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_description" name="meta_description" placeholder="Enter Meta description">{{ old('meta_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Keyword</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keyword">{{ old('meta_keywords') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            

                            
                            
                            

                            
                            


                          
                          </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
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
