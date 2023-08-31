<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\BusinessCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class BusinessCategoryController 
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
        if(!auth()->user()->hasPermission('manage_business_listing'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = BusinessCategory::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.business_category.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        if(!auth()->user()->hasPermission('create_business_category'))
        {
            abort(404, 'You are not Authorised...');
        }
        return view('admin.business_category.create');
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_business_category'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'icon' => 'required',
            
        ]);

        if ($all['icon']) 
        {
            $image = $all['icon'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_business_icon'), $imageName);
        }

        $all['name']                    = ucfirst($all['name']);
        $all['color']                   = strtoupper($all['color']);
        $all['slug']                    = Str::slug(strtolower($all['name']));
        $all['icon']                    = $imageName ?? NULL;
        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        BusinessCategory::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('business_category.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = BusinessCategory::findOrFail($id);
        return view('admin.business_category.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_business_category'))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $results                        = BusinessCategory::findOrFail($id);
        return view('admin.business_category.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_business_category'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            
        ]);


        $all['name']                    = ucfirst($all['name']);
        $all['color']                   = strtoupper($all['color']);
        $all['slug']                    = Str::slug(strtolower($all['name']));
        $all['updated_at']              = date('Y-m-d H:i:s');
        $result                         = BusinessCategory::findOrFail($id);
        
        if (isset($all['icon'])) {

            $image                      = $all['icon'];
            $imageName                  = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_business_icon'), $imageName);
            
            $result->update([
                'name'                  => $all['name'],
                'color'                 => $all['color'],
                'slug'                  => $all['slug'],
                'updated_at'            => $all['updated_at'],
                'icon'                  => $imageName
            ]);

        } else {
            $result->update([
                'name'                  => $all['name'],
                'color'                 => $all['color'],
                'slug'                  => $all['slug'],
                'updated_at'            => $all['updated_at']
            ]);
        }

        // Redirect to the index page with a success message
        return redirect()->route('business_category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BusinessCategory $businessCategory)
    {
        if(!auth()->user()->hasPermission('delete_business_category'))
        {
            abort(404, 'You are not Authorised...');
        }

        $businessCategory->delete();
        return redirect()->route('business_category.index')->with('success', 'Category deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = BusinessCategory::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('business_category.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
