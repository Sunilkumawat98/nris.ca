<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\CountryStateCityLibrary;
use App\Models\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class CountryStateCityController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->countryStateLibObj       = new CountryStateCityLibrary();
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_location'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Retrieve all countries using Eloquent ORM
        $countries                      = Country::orderBy('id', 'DESC')->paginate(3); // Change the pagination size as needed (e.g., 10 countries per page)
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $countries->lastPage()) ? $currentPage + 1 : null;


        return view('admin.country.index', compact('countries', 'previousPage', 'nextPage'));
    
    }


    public function create()
    {
        return view('admin.country.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_country'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'code' => 'required',
            'c_meta_title' => 'required',
            'c_meta_description' => 'required',
            'c_meta_keywords' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['color']                   = strtolower($all['color']);
        $all['code']                    = strtoupper($all['code']);
        $all['domain']                  = Str::slug(strtolower($all['name']));
        $all['image']                   = 'NA';

        // Create a new post
        Country::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('country.index')->with('success', 'Country created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $country                        = Country::findOrFail($id);
        return view('admin.country.show', compact('country'));
    }

    public function edit($id)
    {
        // Find the post by its ID and pass it to the view for editing
        $country                        = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_country'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'code' => 'required',
            'c_meta_title' => 'required',
            'c_meta_description' => 'required',
            'c_meta_keywords' => 'required',
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['color']                   = strtolower($all['color']);
        $all['code']                    = strtoupper($all['code']);
        $all['domain']                  = Str::slug(strtolower($all['name']));
        $all['image']                   = 'NA';

        $country                        = Country::findOrFail($id);
        $country->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('country.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        if(!auth()->user()->hasPermission('delete_country'))
        {
            abort(404, 'You are not Authorised...');
        }
        $country->delete();
        return redirect()->route('country.index')->with('success', 'Country deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $country = Country::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $country->is_live = ($country->is_live === 1) ? 0 : 1;
        $country->save();

        return redirect()->route('country.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
