<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RatingSource;
use App\Models\MovieRating;
use App\Models\DesiMovie;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Exception;

class DesiMovieController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = DesiMovie::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.desi_movies.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        if(!auth()->user()->hasPermission('create_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }

        $countries                      = Country::all();
        $states                         = State::all();
        $cities                         = City::all();
        

        return view('admin.desi_movies.create', compact('countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();

        $date = $all['date'];
        $expDate = explode("-",$date);
        $from_dt = $expDate[0];
        $to_dt = $expDate[1];

        $from = strtotime($from_dt);
        $to = strtotime($to_dt);

        $new_date_from = date('Y-m-d', $from);
        $new_date_to = date('Y-m-d', $to);

        // Validate the request data
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'image' => 'required|max:512',
        ],
        [
            'image.required' => 'The image field is required.',
            'image.max' => 'The image size should not exceed 512KB.',
        ]);

        


        if ($all['image']) 
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_desi_movie_img'), $imageName);
        }
        
        $all['end_date']                 = $new_date_to;
        $all['name']                     = ucfirst($all['name']);
        $all['slug']                     = Str::slug(strtolower($all['name']));
        $all['start_date']               = $new_date_from;
        $all['image']                    = $imageName ?? NULL;
        
        $citiesList = implode(",", $all['city_id']);
        
        $all['city_id']                  = $citiesList;

        $all['created_at']               = date('Y-m-d H:i:s');
        $all['updated_at']               = date('Y-m-d H:i:s');

        // Create a new post
        DesiMovie::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('desi_movies.index')->with('success', 'Desi movies created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = DesiMovie::findOrFail($id);
        return view('admin.desi_movies.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing    
        $results                        = DesiMovie::findOrFail($id);    
        $countries                      = Country::all();
        $states                         = State::all();
        $cities                         = City::all();
        

        return view('admin.desi_movies.edit', compact('countries', 'states', 'cities', 'results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $date                           = $all['date'];
        $expDate                        = explode("-",$date);
        $from_dt                        = $expDate[0];
        $to_dt                          = $expDate[1];

        $from                           = strtotime($from_dt);
        $to                             = strtotime($to_dt);

        $new_date_from                  = date('Y-m-d', $from);
        $new_date_to                    = date('Y-m-d', $to);

        // Validate the request data
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
        ]);


        if ($request->has('image'))
        {
            $image                      = $all['image'];
            $imageName                  = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_desi_movie_img'), $imageName);
            $all['image']                    = $imageName ?? NULL;
        }
        
        $all['end_date']                 = $new_date_to;
        $all['name']                     = ucfirst($all['name']);
        $all['slug']                     = Str::slug(strtolower($all['name']));
        $all['start_date']               = $new_date_from;
        
        $citiesList                      = implode(",", $all['city_id']);
        
        $all['city_id']                  = $citiesList;


        $result                          = DesiMovie::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('desi_movies.index')->with('success', 'Desi movies updated successfully.');
    }

    public function destroy(DesiMovie $desiMovie)
    {
        if(!auth()->user()->hasPermission('delete_desi_movies'))
        {
            abort(404, 'You are not Authorised...');
        }

        $desiMovie->delete();
        return redirect()->route('desi_movies.index')->with('success', 'Desi movies deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = DesiMovie::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('desi_movies.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
