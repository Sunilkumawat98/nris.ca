<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;
use App\Models\BusinessListing;
use App\Models\Country;
use App\Models\State;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class BusinessListingController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'business_listing';
        $this->route                    = 'business_listing';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_business_listing'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = BusinessListing::where('status', 1);
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
        $categories                          = BusinessCategory::all();
        $subcategories                       = BusinessSubCategory::all();
        $countries                           = Country::all();
        $states                              = State::all();
        return view('admin.'.$this->route.'.create', compact('categories', 'subcategories', 'countries', 'states'));
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
            'country_id' => 'required',
            'state_id' => 'required',
            'cat_id' => 'required',
            'image' => 'required|max:512',
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_number' => 'required|numeric',
            'contact_address' => 'required|string',
        ],
        [
            'image.required' => 'The image field is required.',
            'image.max' => 'The image size should not exceed 512KB.',
        ]);

        if ($all['image']) 
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_business_img'), $imageName);
        }
        
        $all['name']                    = ucfirst($all['name']);
        $all['name_slug']               = Str::slug(strtolower($all['name']));
        $all['image']                    = $imageName ?? NULL;
        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');




        // Create a new post
        BusinessListing::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Sub Category created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = BusinessListing::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                             = BusinessListing::findOrFail($id);
        $categories                          = BusinessCategory::all();
        $subcategories                       = BusinessSubCategory::all();
        $countries                           = Country::all();
        $states                              = State::all();
        
        return view('admin.'.$this->route.'.edit', compact('results', 'categories', 'subcategories', 'countries', 'states'));
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
            'country_id' => 'required',
            'state_id' => 'required',
            'cat_id' => 'required',
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_number' => 'required|numeric',
            'contact_address' => 'required|string',
            
        ]);
        
        if ($request->has('image'))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_business_img'), $imageName);

            $all['image']                       = $imageName;
        }

        $all['name']                        = ucfirst($all['name']);
        $all['name_slug']                   = Str::slug(strtolower($all['name']));
        

        $all['updated_at']                  = date('Y-m-d H:i:s');

        $result                             = BusinessListing::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(BusinessListing $businessListing)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }

        $businessListing->delete();
        return redirect()->route($this->route.'.index')->with('success', 'Record deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = BusinessListing::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
