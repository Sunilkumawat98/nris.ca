@extends('layouts.main')

@section('title', 'Nris Dashboard | City Edit')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>City Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">City</li>
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
                    <h3 class="card-title">Edit City</h3>
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
                <form action="{{ route('city.update', $results->id) }}" method="POST">
              @csrf
              @method('PUT')
                <!-- /.card-header -->
              <div class="card-body">
             
              <input type="hidden" class="form-control"  name="id" value="{{ $results->id }}" readonly>
                  <div class="form-group">
                    <label>Select Country</label>
                    <select class="form-control select2 select2-danger" name="country_id" id="country_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="" >Select Country</option>
                        @foreach($countries as $item)
                              <option value="{{ $item->id }}" {{ $results->country_id == $item->id ? 'selected' : '' }} > {{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Select State</label>
                    <select class="form-control select2 select2-danger" name="state_id" id="state_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="" >Select State</option>
                        @foreach($states as $item)
                              <option value="{{ $item->id }}" {{ $results->state_id == $item->id ? 'selected' : '' }} > {{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                      <label for="name">City Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $results->name }}" placeholder="Enter state name">
                  </div>

                  <div class="form-group">
                      <label>State Code:</label>
                    <input type="text" class="form-control" id="state_code" name="state_code" value="{{ $results->state_code }}" placeholder="Enter state code">
                  </div>

                  <div class="form-group">
                      <label>City Code:</label>
                    <input type="text" class="form-control" id="city_code" name="code" value="{{ $results->code }}" placeholder="Enter city code">
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
