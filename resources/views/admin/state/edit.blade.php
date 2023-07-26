@extends('layouts.main')

@section('title', 'Nris Dashboard | State Edit')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>State Edit</h1>

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
              <li class="breadcrumb-item">State</li>
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
                    <h3 class="card-title">Edit State</h3>
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
                <form action="{{ route('state.update', $results->id) }}" method="POST">
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
                      <label for="name">State Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $results->name }}" placeholder="Enter state name">
                  </div>

                  <div class="form-group">
                      <label>State Code:</label>
                    <input type="text" class="form-control" id="state_code" name="code" value="{{ $results->code }}" placeholder="Enter state code">
                  </div>
                

                  <div class="form-group">
                      <label>Description:</label>
                    <textarea row="4" class="form-control" id="description" name="description" placeholder="Enter description">{{ $results->description }}</textarea>
                  </div>
                

                  <div class="form-group">
                      <label>Meta Title:</label>
                    <textarea row="4" class="form-control" id="s_meta_title" name="s_meta_title" placeholder="Enter meta title">{{ $results->s_meta_title }}</textarea>
                  </div>
                

                  <div class="form-group">
                      <label>Meta Description:</label>
                    <textarea row="4" class="form-control" id="s_meta_description" name="s_meta_description" placeholder="Enter meta description"> {{ $results->s_meta_description }} </textarea>
                  </div>

                  

                  <div class="form-group">
                      <label>Meta Keyword:</label>
                    <textarea row="4" class="form-control" id="s_meta_keywords" name="s_meta_keywords" placeholder="Enter meta Keyword" >{{ $results->s_meta_keywords }} </textarea>
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
