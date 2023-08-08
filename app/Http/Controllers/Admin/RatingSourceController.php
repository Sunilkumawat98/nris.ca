<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\RatingSource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class RatingSourceController 
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
        if(!auth()->user()->hasPermission('manage_rating_source'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = RatingSource::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.rating_source.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        return view('admin.rating_source.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_rating_source'))
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
        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        RatingSource::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('rating_source.index')->with('success', 'Source created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = RatingSource::findOrFail($id);
        return view('admin.rating_source.show', compact('results'));
    }

    public function edit($id)
    {
        // Find the post by its ID and pass it to the view for editing
        $results                        = RatingSource::findOrFail($id);
        return view('admin.rating_source.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_rating_source'))
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

        $result                        = RatingSource::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('rating_source.index')->with('success', 'Source updated successfully.');
    }

    public function destroy(RatingSource $ratingSource)
    {
        if(!auth()->user()->hasPermission('delete_rating_source'))
        {
            abort(404, 'You are not Authorised...');
        }

        $ratingSource->delete();
        return redirect()->route('rating_source.index')->with('success', 'Source deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = RatingSource::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('rating_source.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
