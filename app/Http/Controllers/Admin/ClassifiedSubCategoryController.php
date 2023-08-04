<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClassifiedCategory;
use App\Models\ClassifiedSubCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class ClassifiedSubCategoryController 
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
        if(!auth()->user()->hasPermission('manage_free_classifieds'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = ClassifiedSubCategory::where('status', 1);
        if ($searchQuery) {
            $results->where('name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
        }

        $results = $results->orderBy('id', 'DESC')->paginate(10);

        // Retrieve all state using Eloquent ORM
        
        $currentPage                    = request()->query('page', 1);

        // Calculate the previous and next pages for forward and backward navigation
        $previousPage                   = ($currentPage > 1) ? $currentPage - 1 : null;
        $nextPage                       = ($currentPage < $results->lastPage()) ? $currentPage + 1 : null;


        return view('admin.classified_sub_category.index', compact('results', 'previousPage', 'nextPage', 'searchQuery'));
    
    }


    public function create()
    {
        $categories                          = ClassifiedCategory::all();
        return view('admin.classified_sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_classified_subcategory'))
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
        $all['color']                    = strtoupper($all['color']);
        $all['slug']                    = Str::slug(strtolower($all['name']));
        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        ClassifiedSubCategory::create($all);

        // Redirect to the index page with a success message
        return redirect()->route('classified_sub_category.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = ClassifiedSubCategory::findOrFail($id);
        return view('admin.classified_sub_category.show', compact('results'));
    }

    public function edit($id)
    {
        // Find the post by its ID and pass it to the view for editing
        $results                        = ClassifiedSubCategory::findOrFail($id);
        $categories                     = ClassifiedCategory::all();
        return view('admin.classified_sub_category.edit', compact('results', 'categories'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_classified_subcategory'))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'color' => 'required',
            
        ]);

        $all['name']                    = ucfirst($all['name']);
        $all['color']                    = strtoupper($all['color']);
        $all['slug']                    = Str::slug(strtolower($all['name']));

        $all['updated_at']              = date('Y-m-d H:i:s');

        $result                        = ClassifiedSubCategory::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route('classified_sub_category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ClassifiedSubCategory $classifiedsubCategory)
    {
        if(!auth()->user()->hasPermission('delete_classified_subcategory'))
        {
            abort(404, 'You are not Authorised...');
        }

        $classifiedsubCategory->delete();
        return redirect()->route('classified_sub_category.index')->with('success', 'Category deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = ClassifiedSubCategory::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route('classified_sub_category.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
