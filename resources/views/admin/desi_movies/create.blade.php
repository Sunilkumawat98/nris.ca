@extends('layouts.main')

@section('title', 'Nris Dashboard | Desi Movie Add')
<style type="text/css">
  /* Custom styles for the card height */
  .custom-card-height {
    height: 1000px; /* Adjust the height as per your requirement */
  }


/* Full-page loader overlay styles */
#loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure the loader is on top of all content */
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.hidden {
    display: none;
}
</style>

@section('content')
     <!-- Content Wrapper. Contains page content -->
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
            <div id="loader-overlay" >
                <!-- You can customize the loader animation or message here -->
                <div class="loader"></div>
            </div>
          <!-- general form elements -->
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Add New Desi Movie</h3>
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
            <form class="form-horizontal" action="{{ route('desi_movies.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group row">
                              <label for="name">Movie Name</label>
                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter movie name">
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
                                        <input type="text" class="form-control float-right" id="reservationtime" name="date">
                                  </div> 
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-3 col-form-label">Movie Url (if any)</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" placeholder="Enter movie url">
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
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    
                                </select> 

                              
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9 select2-purple">
                                <select class="form-control select2 select2-danger" multiple="multiple" name="city_id[]" id="city_id" data-dropdown-css-class="select2-danger" >
                                    <option value="" >Select City</option>
                                    
                                </select>   
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="address" name="address" placeholder="Enter address">{{ old('address') }}</textarea>
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
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Other Info</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="additional_info" name="additional_info" placeholder="Enter other info">{{ old('additional_info') }}</textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Title</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="meta_title" name="meta_title" placeholder="Enter meta title">{{ old('meta_title') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="meta_description" name="meta_description" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Meta Keyword</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keyword">{{ old('meta_keywords') }}</textarea>
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

</div>


@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {
        var loader = document.getElementById("loader-overlay");       
        
        loader.style.display = "none";
        
        $('#country_id').on('change', function() {
              
            loader.style.display = "block";
          
            var country_id = $(this).val();
            $('#state_id').html('<option value="">Loading...</option>');
            
            axios.get('/get-state-by-country-id', {
                params: {
                    country_id: country_id
                }
            })
            .then(function(response) {
                loader.style.display = "none";
                var states = response.data;
                var stateDropdown = $('#state_id');
                stateDropdown.empty();
                stateDropdown.append('<option value="">Select state</option>');

                $.each(states, function(index, state) {
                    stateDropdown.append('<option value="' + state.id + '">' + state.name + '</option>');
                });
            })
            .catch(function(error) {
              loader.style.display = "none";
                console.error(error);
            });
        });



        $('#state_id').on('change', function() {
              
              loader.style.display = "block";
            
              var state_id = $(this).val();
              $('#city_id').html('<option value="">Loading...</option>');
              
              axios.get('/get-city-by-state-id', {
                  params: {
                    state_id: state_id
                  }
              })
              .then(function(response) {
                  loader.style.display = "none";
                  var cities = response.data;
                  var cityDropdown = $('#city_id');
                  cityDropdown.empty();
                  cityDropdown.append('<option value="">Select city</option>');
  
                  $.each(cities, function(index, city) {
                    cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                  });
              })
              .catch(function(error) {
                loader.style.display = "none";
                  console.error(error);
              });
          });
    });
</script>

