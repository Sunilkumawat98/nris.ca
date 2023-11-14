@extends('layouts.main')

@section('title', 'Nris Dashboard | Classified Sub Category Add')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Classified Sub Category</h1>

            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Classified Sub Category</li>
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
                    <h3 class="card-title">Create Classified Sub Category</h3>
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
                <form action="{{ route('classified_sub_sub_category.store') }}" method="POST">
              @csrf
                <!-- /.card-header -->
              <div class="card-body">
             
                    <div class="form-group">
                      <label>Select Category</label>
                      <select class="form-control select2 select2-danger" name="sub_category_id" id="sub_category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option value="" >Select Sub Category</option>
                          @foreach($categories as $item)
                                <option value="{{ $item->id }}" {{ old('sub_category_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                          @endforeach
                      </select>
                    </div>

                  <div class="form-group">
                      <label for="name">Sub Sub Category Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter state name">
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
