<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class StateController 
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
        if(!auth()->user()->hasPermission('manage_location'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all state using Eloquent ORM
        $results                      = State::where('status', 1)->orderBy('id', 'DESC')->paginate(10); 
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.state.index', compact('results', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        $countries                      = Country::all();
        return view('admin.state.create', compact('countries'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_state'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'code' => 'required',
            'description' => 'required',
            's_meta_title' => 'required',
            's_meta_description' => 'required',
            's_meta_keywords' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper($all['code']);
        $all['domain']                  = Str::slug(strtolower($all['name']));
        $all['logo']                    = 'NA';
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        State::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('state.index')->with('success', 'State created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = State::findOrFail($id);
        return view('admin.state.show', compact('results'));
    }

    public function edit($id)
    {
        // Find the post by its ID and pass it to the view for editing
        $results                        = State::findOrFail($id);
        $countries                      = Country::all();
        return view('admin.state.edit', compact('results', 'countries'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_state'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'code' => 'required',
            'description' => 'required',
            's_meta_title' => 'required',
            's_meta_description' => 'required',
            's_meta_keywords' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper($all['code']);
        $all['domain']                  = Str::slug(strtolower($all['name']));
        $all['logo']                    = 'NA';
        $all['updated_at']              = date('Y-m-d H:i:s');

        $states                        = State::findOrFail($id);
        $states->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('state.index')->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        if(!auth()->user()->hasPermission('delete_state'))
        {
            abort(404, 'You are not Authorised...');
        }

        $state->delete();
        return redirect()->route('state.index')->with('success', 'State deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = State::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('state.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
