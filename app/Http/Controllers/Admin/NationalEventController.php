<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\EventCategory;
use App\Models\NationalEvent;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class NationalEventController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'national_events';
        $this->route                    = 'national_events';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_national_event'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = NationalEvent::where('status', 1);
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
        
        $categories                          = EventCategory::all();
        $cities                              = City::all();
        $countries                           = Country::all();
        $states                              = State::all();
        return view('admin.'.$this->route.'.create', compact('categories', 'cities', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();

        $date = $all['date'];
        $expDate = explode("-",$date);
        $from_dt = $expDate[0];
        $to_dt = $expDate[1];

        $from = strtotime($from_dt);
        $to = strtotime($to_dt);

        $new_date_from = date('Y-m-d', $from);
        $new_date_to = date('Y-m-d', $to);

        // Validate the request data
        $request->validate([
            'title' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'cat_id' => 'required',            
            'url' => 'required',
            'address' => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_events_img'), $imageName);
            $all['image']                    = $imageName ?? NULL;
        }

        $all['title']                    = ucfirst($all['title']);
        $all['title_slug']               = Str::slug(strtolower($all['title']));
        $all['start_date']               = $new_date_from;
        $all['end_date']                 = $new_date_to;        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        // Create a new post
        NationalEvent::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'National Event created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = NationalEvent::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $categories                          = EventCategory::all();
        $cities                              = City::all();
        $countries                           = Country::all();
        $states                              = State::all();
        $results                        = NationalEvent::findOrFail($id);
        return view('admin.'.$this->route.'.edit', compact('results','categories', 'cities', 'countries', 'states'));
        
        
        // return view('admin.'.$this->route.'.edit', compact('results'));
    }

    

    public function update(Request $request, $id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $all                            = $request->all();

        $date = $all['date'];
        $expDate = explode("-",$date);
        $from_dt = $expDate[0];
        $to_dt = $expDate[1];

        $from = strtotime($from_dt);
        $to = strtotime($to_dt);

        $new_date_from = date('Y-m-d', $from);
        $new_date_to = date('Y-m-d', $to);

        // Validate the request data
        $request->validate([
            'title' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'cat_id' => 'required',            
            'url' => 'required',
            'address' => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.upload_events_img'), $imageName);
            $all['image']                    = $imageName ?? NULL;
        }

        $all['title']                    = ucfirst($all['title']);
        $all['title_slug']               = Str::slug(strtolower($all['title']));
        $all['start_date']               = $new_date_from;
        $all['end_date']                 = $new_date_to;        
        $all['created_at']              = date('Y-m-d H:i:s');
        $all['updated_at']              = date('Y-m-d H:i:s');

        

        $result                        = NationalEvent::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'National events updated successfully.');
    }

    public function destroy(NationalEvent $nationalEvent)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $nationalEvent->delete();
        return redirect()->route($this->route.'.index')->with('success', 'Category deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = NationalEvent::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
