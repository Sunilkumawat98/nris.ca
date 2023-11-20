@extends('layouts.main')


@php
    $page_name = 'Movie Video';
    $routeUrl = 'movie_video';
    $permission = 'movie_videos';
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
                                  <label for="name">Name</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                                  </div>
                              </div>
                          </div>
                          
                          <div class="row">    
                            

                            <div class="col-sm-12">
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select2-danger" name="category_id" id="category_id" data-dropdown-css-class="select2-danger">
                                      <option value="" >Select Category</option>
                                      @foreach($categories as $item)
                                            <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                      @endforeach
                                  </select> 
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Language</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select2-danger" name="language_id" id="language_id" data-dropdown-css-class="select2-danger">
                                      <option value="" >Select Category</option>
                                      @foreach($languages as $item)
                                            <option value="{{ $item->id }}" {{ old('language_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                      @endforeach
                                  </select> 
                                </div>
                              </div>
                            </div>
                            
                            

                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}" placeholder="Enter Url">
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
