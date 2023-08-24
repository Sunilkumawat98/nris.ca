@extends('layouts.main')

@section('title', 'Nris Dashboard | City Add')


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
              // print_r($countries);
              // echo "</pre>";
            ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">City</li>
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
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create City</h3>
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
                <form action="{{ route('city.store') }}" method="POST">
              @csrf
                <!-- /.card-header -->
              <div class="card-body">
             
                    <div class="form-group">
                      <label>Select Country</label>
                      <select class="form-control select2 select2-danger" name="country_id" id="country_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option value="" >Select Country</option>
                          @foreach($countries as $item)
                                <option value="{{ $item->id }}" {{ old('country_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Select State</label>
                      <select class="form-control select2 select2-danger" name="state_id" id="state_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option value="" >Select State</option>
                          @foreach($states as $item)
                                <option value="{{ $item->id }}" {{ old('state_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="name">City Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter city name">
                    </div>
                    
                    
                    <div class="form-group">
                        <label>State Code:</label>
                      <input type="text" class="form-control" id="state_code" name="state_code" value="{{ old('state_code') }}" placeholder="Enter state code">
                    </div>
                  
                    <div class="form-group">
                        <label>City Code:</label>
                      <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" placeholder="Enter city code">
                    </div>
                

                  

                  

              </div>
                <!-- /.card-body -->              
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
