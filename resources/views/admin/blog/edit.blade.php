@extends('layouts.main')



@php
    $page_name = 'Blog';
    $routeUrl = 'blog';
    $permission = 'blog';
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
              <li class="breadcrumb-item active">Edit </li>
       


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
                  <h3 class="card-title">Edit {{ $page_name }}</h3>
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
                <form class="form-horizontal" action="{{ route($routeUrl.'.update', [$results->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="card-body">
                      
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                  <label for="name">Title</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="title" name="title" value="{{ $results->title }}" placeholder="Enter title">
                                  </div>
                              </div>
                          </div>
                          
                          <div class="row">    
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="image" name="image" class="form-control" placeholder="select Image" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select2-danger" name="cat_id" id="cat_id" data-dropdown-css-class="select2-danger">
                                      <option value="" >Select Category</option>
                                      @foreach($categories as $item)
                                            <option value="{{ $item->id }}" {{ $results->cat_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                      @endforeach
                                  </select> 
                                </div>
                              </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="Enter description">{{ $results->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_title" name="meta_title" placeholder="Enter Meta title">{{ $results->meta_title }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_description" name="meta_description" placeholder="Enter Meta description">{{ $results->meta_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Keyword</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keyword">{{ $results->meta_keywords }}</textarea>
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
