<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Blog;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\BlogCategory;
use App\Models\NationalEvent;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use Exception;

class BlogController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'blog';
        $this->route                    = 'blog';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_blog'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = Blog::where('status', 1);
        if ($searchQuery) {
            $results->where('title', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
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
        
        $categories                          = BlogCategory::all();
        return view('admin.'.$this->route.'.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();


        // echo "<pre>";
        // print_r($all);
        // echo "</pre>";
        // die();
        // Validate the request data
        $request->validate([
            'title'                     => 'required',
            'cat_id'                    => 'required',
            'image'                     => 'required',
            'description'               => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.blog_img'), $imageName);
            $all['image']                = $imageName ?? NULL;
        }

        $all['title']                    = ucfirst($all['title']);
        $all['slug']                     = Str::slug(strtolower($all['title']));
        $all['admin_id']                 = auth()->user()->id;
              
        $all['created_at']               = date('Y-m-d H:i:s');
        $all['updated_at']               = date('Y-m-d H:i:s');

        // Create a new post
        Blog::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = Blog::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $categories                          = BlogCategory::all();
        $results                             = Blog::findOrFail($id);
        
        return view('admin.'.$this->route.'.edit', compact('results','categories'));
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
            'title'                     => 'required',
            'cat_id'                    => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image                      = $all['image'];
            $imageName                  = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.blog_img'), $imageName);
            $all['image']               = $imageName ?? NULL;
        }

        $all['title']                    = ucfirst($all['title']);
        $all['slug']                     = Str::slug(strtolower($all['title']));
        $all['admin_id']                 = auth()->user()->id;
        $all['created_at']               = date('Y-m-d H:i:s');
        $all['updated_at']               = date('Y-m-d H:i:s');

        

        $result                        = Blog::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $blog->delete();
        return redirect()->route($this->route.'.index')->with('success', 'deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = Blog::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
