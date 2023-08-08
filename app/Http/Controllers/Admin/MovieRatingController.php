<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RatingSource;
use App\Models\MovieRating;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Exception;

class MovieRatingController 
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
        if(!auth()->user()->hasPermission('manage_movie_ratings'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = MovieRating::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.movie_rating.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        // $results                      = RatingSource::where('status', 1)->get();
        // if(count($results)>0)
        // {
        //     $results = $results->toArray();
        // }

       
		$data['rating']['rating_data'] = array();

		$data['sources'] = RatingSource::all();

        // return view('admin.movie_rating.create', compact('results'));
        return view('admin.movie_rating.create', $data);
    }

    public function store(Request $request, $id = 0)
    {
        if(!auth()->user()->hasPermission('create_movie_ratings'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            
        ]);

        $rating = [];

        foreach ($all['rating_data'] as $key => $val)
        {

            $collection = new Collection($val[0]);
            if ($collection->isNotEmpty()) 
            {
                $rating[$key] = $val;
            }
            
        }

        $all['name']                    = ucfirst($all['name']);
        $all['slug']                    = Str::slug(strtolower($all['name']));

        $all['rating_data']             = json_encode($rating);
        // $all['rating_data']             = $request->rating_data;
        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        MovieRating::create($all);



        // $rating = MovieRating::findOrNew($id);
		

		// $rating->name = $all['name'];
        // $rating->rating_data = $request->rating_data;
        // $rating->save();




        // Redirect to the index page with a success message
        return redirect()->route('movie_rating.index')->with('success', 'Rating created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = MovieRating::findOrFail($id);
        return view('admin.movie_rating.show', compact('results'));
    }

    public function edit($id)
    {
        // Find the post by its ID and pass it to the view for editing        
        $data['rating']                = MovieRating::findOrFail($id);
		$data['rating']['rating_data'] = !empty($data['rating']->rating_data) ? json_decode($data['rating']->rating_data, true) : [];
		$data['sources'] = RatingSource::all();
		return view('admin.movie_rating.edit', $data);
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_movie_ratings'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['slug']                    = Str::slug(strtolower($all['name']));

        $all['updated_at']              = date('Y-m-d H:i:s');

        $result                        = MovieRating::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('movie_rating.index')->with('success', 'Rating updated successfully.');
    }

    public function destroy(MovieRating $movieRating)
    {
        if(!auth()->user()->hasPermission('delete_movie_ratings'))
        {
            abort(404, 'You are not Authorised...');
        }

        $movieRating->delete();
        return redirect()->route('movie_rating.index')->with('success', 'Rating deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = MovieRating::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('movie_rating.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
