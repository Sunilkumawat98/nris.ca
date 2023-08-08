@extends('layouts.main')

@section('title', 'Nris Dashboard | Desi Movie Edit')


@section('content')
     
    <!-- Main content -->
          
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Desi Movie</h1>

          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Desi Movie</li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Edit Desi Movie</h3>
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
            <form class="form-horizontal" action="{{ route('desi_movies.update', [$results->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div class="card-body">
                  <input type="hidden" class="form-control"  name="id" value="{{ $results->id }}" readonly>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group row">
                              <label for="name">Movie Name</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $results->name }}" placeholder="Enter movie name">
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">                        
                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-3 col-form-label">Start and End Date:</label>
                              <div class="col-sm-9">
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                      </div>
                                        <input type="text" class="form-control float-right" id="reservationtime" name="date" value="{{ $results->start_date }} {{ $results->end_date }}">
                                  </div> 
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-3 col-form-label">Movie Url (if any)</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="url" name="url" value="{{ $results->url }}" placeholder="Enter movie url">
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
                            <label for="inputPassword3" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 select2-danger" name="city_id" id="city_id" data-dropdown-css-class="select2-danger" >
                                    <option value="" >Select City</option>
                                    @foreach($cities as $item)
                                          <option value="{{ $item->id }}" {{ $results->city_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>   
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="address" name="address" placeholder="Enter address">{{ $results->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" id="image" name="image" class="form-control" placeholder="select Image" value="{{ $results->image }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Other Info</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="additional_info" name="additional_info" placeholder="Enter other info">{{ $results->additional_info }}</textarea>
                                </div>
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
@endsection
