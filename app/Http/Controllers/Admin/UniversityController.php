<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\University;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class UniversityController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'university';
        $this->route                    = 'university';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_student_talk'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = University::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.'.$this->route.'.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        if(!auth()->user()->hasPermission('create_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        return view('admin.'.$this->route.'.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_'.$this->permission))
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
        University::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = University::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = University::findOrFail($id);
        
        return view('admin.'.$this->route.'.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
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

        $result                        = University::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Updated successfully.');
    }

    public function destroy(University $university)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $university->delete();
        return redirect()->route($this->route.'.index')->with('success', 'Deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = University::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
