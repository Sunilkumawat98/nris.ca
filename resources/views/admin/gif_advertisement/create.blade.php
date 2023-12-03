@extends('layouts.main')


@php
    $page_name = 'Gif Ads';
    $routeUrl = 'gif_advertisement';
    $permission = 'gif_advertisement';
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
                                  <label for="name">Ad name</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="ad_name" name="ad_name" value="{{ old('ad_name') }}" placeholder="Enter ad name">
                                  </div>
                              </div>
                          </div>

                          
                          
                          <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">amount</label>
                                    <div class="col-sm-9">
                                        <input type="textbox" id="amount" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="enter amount" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">click Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="click_url" name="click_url" value="{{ old('click_url') }}" placeholder="Enter Url">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Start and End Date:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                          <input type="text" class="form-control float-right" id="reservationtime" name="date">
                                    </div> 
                                </div>
                              </div>
                            </div>                    
                              <div class="col-sm-6">
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-3 col-form-label">Country</label>
                                  <div class="col-sm-9">
                                      <select class="form-control select2 select2-danger" name="country_id" id="country_id" data-dropdown-css-class="select2-danger" >
                                          <option value="" >Select Country</option>
                                          @foreach($countries as $item)
                                                <option value="{{ $item->id }}" {{ old('country_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
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
                                            <option value="{{ $item->id }}" {{ old('state_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                      @endforeach
                                  </select> 
                                </div>
                              </div>
                            </div>


                            <div class="col-sm-6">
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

                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">ad position</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ad_position" id="ad_position">
                                      <option value="" >Select Position</option>
                                      <option value="top" {{ old('ad_position') == 'top' ? 'selected' : '' }} >Top</option>                                      
                                      <option value="left" {{ old('ad_position') == 'left' ? 'selected' : '' }} >Left</option>                                      
                                      <option value="right" {{ old('ad_position') == 'right' ? 'selected' : '' }} >Right</option>                                      
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
                                    <label for="name" class="col-sm-3 col-form-label">Ad contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ad_contact" name="ad_contact" value="{{ old('ad_contact') }}" placeholder="Enter Contact">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Ad Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" id="ad_address" name="ad_address" placeholder="Enter address">{{ old('ad_address') }}</textarea>
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
