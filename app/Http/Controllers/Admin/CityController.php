<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class CityController 
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
        $searchQuery = $request->input('search');
        // Retrieve all city using Eloquent ORM
        $results                      = City::where('status', 1); 
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }
        $results = $results->orderBy('id', 'DESC')->paginate(10);
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.city.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        $countries                      = Country::all();
        $states                         = State::all();
        return view('admin.city.create', compact('countries', 'states'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_city'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'state_code' => 'required',
            'code' => 'required'
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper($all['code']);
        $all['state_code']              = strtoupper($all['state_code']);
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        City::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('city.index')->with('success', 'City created successfully.');
    }

    public function show($id)
    {
        if(!auth()->user()->hasPermission('show_city'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view
        $results                        = City::findOrFail($id);
        return view('admin.city.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_city'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = City::findOrFail($id);
        $countries                      = Country::all();
        $states                         = State::all();
        return view('admin.city.edit', compact('results', 'countries', 'states'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_city'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'state_code' => 'required',
            'code' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['code']                    = strtoupper($all['code']);
        $all['updated_at']              = date('Y-m-d H:i:s');

        $results                        = City::findOrFail($id);
        $results->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('city.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        if(!auth()->user()->hasPermission('delete_city'))
        {
            abort(404, 'You are not Authorised...');
        }

        $city->delete();
        return redirect()->route('city.index')->with('success', 'City deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = City::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('city.index')->with('success', 'Live status updated successfully.');
    }
    


    public function getCityByStateId(Request $request)
    {
        $id = $request->input('state_id');
        $states = City::where('state_id', $id)->get();
    
        return response()->json($states);
    }
    

    
    
    
    
}
