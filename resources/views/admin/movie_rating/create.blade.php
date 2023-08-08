@extends('layouts.main')

@section('title', 'Nris Dashboard | Movie Rating Add')


@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Movie Rating</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Movie Rating</li>
              <li class="breadcrumb-item active">Create New</li>
            </ol>
            

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
          

    <?php 

    // echo "<pre>";
    // print_r($results);
    // echo "</pre>";


?>
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Movie Rating</h3>
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
                <form action="{{ route('movie_rating.store') }}" method="POST">
                  @csrf

                  <div class="col-md-12">
                      <div class="card-body">             
                          <div class="form-group">
                              <label for="name">Movie Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter movie name">
                          </div>
                      </div>
                    </div>
                  @foreach ($sources as $source)
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card-body">             
                            <div class="form-group">
                                <label for="name">Select {{ $source->name}} Rating</label>
                                <select class="form-control" name="rating_data[{{$source->id}}][0]">
                                  <option value="">- Select Rating -</option>
                                  <option value="1" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '1' ? 'selected="selected"' : ''; ?>>1 </option>
                                  <option value="2" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '2' ? 'selected="selected"' : ''; ?>>2 </option>
                                  <option value="2.5" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '2.5' ? 'selected="selected"' : ''; ?>>2.5 </option>
                                  <option value="2.75" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '2.75' ? 'selected="selected"' : ''; ?>>2.75 </option>
                                  <option value="3" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '3' ? 'selected="selected"' : ''; ?>>3 </option>
                                  <option value="3.25" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '3.25' ? 'selected="selected"' : ''; ?>>3.25 </option>
                                  <option value="3.5" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '3.5' ? 'selected="selected"' : ''; ?>>3.5 </option>
                                  <option value="3.75" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '3.75' ? 'selected="selected"' : ''; ?>>3.75 </option>
                                  <option value="4" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '4' ? 'selected="selected"' : ''; ?>>4 </option>
                                  <option value="4.25" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '4.25' ? 'selected="selected"' : ''; ?>>4.25 </option>
                                  <option value="4.5" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '4.5' ? 'selected="selected"' : ''; ?>>4.5 </option>
                                  <option value="4.75" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '4.75' ? 'selected="selected"' : ''; ?>>4.75 </option>
                                  <option value="5" <?php echo isset($rating->rating_data[$source->id]) && $rating->rating_data[$source->id][0] == '5' ? 'selected="selected"' : ''; ?>>5 </option>
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card-body">             
                            <div class="form-group">
                                <label for="name">{{ $source->name }} URL</label>
                                <input type="text" class="form-control" id="url" name="rating_data[{{$source->id}}][1]" value="{{ old('url') }}" placeholder="Enter source url">
                            </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
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
