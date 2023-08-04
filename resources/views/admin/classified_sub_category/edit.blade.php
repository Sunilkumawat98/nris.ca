@extends('layouts.main')

@section('title', 'Nris Dashboard | Classified Sub Category Edit')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Classified Sub Category Edit</h1>

            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Edit Classified Sub Category</li>
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
                    <h3 class="card-title">Edit Classified Sub Category</h3>
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
                <form action="{{ route('classified_sub_category.update', $results->id) }}" method="POST">
              @csrf
              @method('PUT')
                <!-- /.card-header -->
              <div class="card-body">
             
              <input type="hidden" class="form-control"  name="id" value="{{ $results->id }}" readonly>
                  <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control select2 select2-danger" name="category_id" id="category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="" >Select Category</option>
                        @foreach($categories as $item)
                              <option value="{{ $item->id }}" {{ $results->category_id == $item->id ? 'selected' : '' }} > {{ $item->name }}</option>
                        @endforeach
                    </select>
                    
                  </div>

                  <div class="form-group">
                      <label for="name">Sub Category Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $results->name }}" placeholder="Enter state name">
                  </div>

                  <div class="form-group">
                      <label>Color code:</label>
                    <input type="text" class="form-control my-colorpicker1" id="color" name="color" value="{{ $results->color }}" placeholder="Select color code">
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
