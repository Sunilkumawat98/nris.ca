@extends('layouts.main')



@php
    $page_name = 'Business Listing';
    $routeUrl = 'business_listing';
    $permission = 'business_listing';
@endphp



@section('title', 'Nris Dashboard | {{ $page_name }} Edit')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }} Edit</h1>

            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Edit {{ $page_name }}</li>
              <li class="breadcrumb-item active">Edit</li>
       


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
                    <h3 class="card-title">Edit {{ $page_name }}</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route($routeUrl.'.update', $results->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <!-- /.card-header -->
              <div class="card-body">
             
              <input type="hidden" class="form-control"  name="id" value="{{ $results->id }}" readonly>
                  <div class="col-sm-12">
                      <div class="form-group row">
                          <label for="name">Business Name</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="name" name="name" value="{{ $results->name }}" placeholder="Enter business name">
                          </div>
                      </div>
                  </div>

                  <div class="row">                        
                      <div class="col-sm-6">
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                              <select class="form-control select2 select2-danger" name="country_id" id="country_id" data-dropdown-css-class="select2-danger" >
                                  <option value="" >Select Country</option>
                                  @foreach($countries as $item)
                                        <option value="{{ $item->id }}" {{ $results->country_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                      </div>

                    <div class="col-sm-6">
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">State</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 select2-danger" name="state_id" id="state_id" data-dropdown-css-class="select2-danger">
                              <option value="" >Select State</option>
                              @foreach($states as $item)
                                    <option value="{{ $item->id }}" {{ $results->state_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                              @endforeach
                          </select> 
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
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Sub Category</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 select2-danger" name="sub_cat_id" id="sub_cat_id" data-dropdown-css-class="select2-danger">
                              <option value="" >Select Sub Category</option>
                              @foreach($subcategories as $item)
                                    <option value="{{ $item->id }}" {{ $results->sub_cat_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                              @endforeach
                          </select> 
                        </div>
                      </div>
                    </div>
                    
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
                            <label for="name" class="col-sm-3 col-form-label">Contact Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ $results->contact_name }}" placeholder="Enter contact name">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Contact Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact_email" name="contact_email" value="{{ $results->contact_email }}" placeholder="Enter contact email">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Contact Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $results->contact_number }}" placeholder="Enter contact number">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Contact Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="address" name="contact_address" placeholder="Enter address">{{ $results->contact_address }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Other Info</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="other_details" name="other_details" placeholder="Enter other info">{{ $results->other_details }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Title</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="meta_title" name="meta_title" placeholder="Enter meta title">{{ $results->meta_title }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="meta_description" name="meta_description" placeholder="Enter meta description">{{ $results->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Keyword</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keyword">{{ $results->meta_keywords }}</textarea>
                            </div>
                        </div>
                    </div>




                  
                  </div>

              </div>
                <!-- /.card-body -->              
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

              </form>
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
