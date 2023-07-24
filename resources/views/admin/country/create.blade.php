@extends('layouts.main')

@section('title', 'Nris Dashboard | Country Add')


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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Country</li>
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
                    <h3 class="card-title">Create Country</h3>
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
                <form action="{{ route('country.store') }}" method="POST">
              @csrf
                <!-- /.card-header -->
              <div class="card-body">
             
                  <div class="form-group">
                      <label for="country_name">Country Name</label>
                      <input type="text" class="form-control" id="country_name" name="name" value="{{ old('name') }}" placeholder="Enter country name">
                  </div>

                  <div class="form-group">
                      <label>Color picker:</label>
                    <input type="text" class="form-control my-colorpicker1" id="color_code" name="color" value="{{ old('color') }}" placeholder="Select color code">
                  </div>

                  <div class="form-group">
                      <label>Country Code:</label>
                    <input type="text" class="form-control" id="country_code" name="code" value="{{ old('code') }}" placeholder="Enter country code">
                  </div>
                

                  <div class="form-group">
                      <label>Meta Title:</label>
                    <textarea row="4" class="form-control" id="c_meta_title" name="c_meta_title" placeholder="Enter meta title">{{ old('c_meta_title') }}</textarea>
                  </div>
                

                  <div class="form-group">
                      <label>Meta Description:</label>
                    <textarea row="4" class="form-control" id="c_meta_description" name="c_meta_description" placeholder="Enter meta description"> {{ old('c_meta_description') }} </textarea>
                  </div>

                  

                  <div class="form-group">
                      <label>Meta Keyword:</label>
                    <textarea row="4" class="form-control" id="c_meta_keywords" name="c_meta_keywords" placeholder="Enter meta Keyword" >{{ old('c_meta_keywords') }}</textarea>
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
