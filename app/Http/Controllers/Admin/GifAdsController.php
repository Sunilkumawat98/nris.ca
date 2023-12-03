<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ClassifiedCategory;
use App\Models\NationalEvent;

use App\Models\GifAds;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class GifAdsController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'gif_advertisement';
        $this->route                    = 'gif_advertisement';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_gif_advertisement'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = GifAds::where('status', 1);
        if ($searchQuery) {
            $results->where('ad_name', 'like', '%' . $searchQuery . '%'); // Modify 'name' to your actual column for the search
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
        
        $categories                          = ClassifiedCategory::all();
        $countries                           = Country::all();
        $states                              = State::all();
        return view('admin.'.$this->route.'.create', compact('categories', 'countries', 'states'));
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
            'ad_name'               => 'required',
            'amount'                => 'required',
            'click_url'             => 'required',
            'country_id'            => 'required',
            'state_id'              => 'required',
            'category_id'           => 'required',
            'ad_position'           => 'required',
            'image'                 => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.gif_img'), $imageName);
            $all['image']                    = $imageName ?? NULL;
        }

        $all['ad_name']                     = ucfirst($all['ad_name']);
        $all['start_date']                  = $new_date_from;
        $all['end_date']                    = $new_date_to;        
        $all['created_at']                  = date('Y-m-d H:i:s');
        $all['updated_at']                  = date('Y-m-d H:i:s');

        // Create a new post
        GifAds::create($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Gif created successfully.');
    }

    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = GifAds::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function edit($id)
    {
        if(!auth()->user()->hasPermission('edit_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        // Find the post by its ID and pass it to the view for editing
        $categories                          = ClassifiedCategory::all();
        
        $countries                           = Country::all();
        $states                              = State::all();
        $results                             = GifAds::findOrFail($id);
        return view('admin.'.$this->route.'.edit', compact('results','categories', 'countries', 'states'));
        
        
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
            'ad_name'               => 'required',
            'amount'                => 'required',
            'click_url'             => 'required',
            'country_id'            => 'required',
            'state_id'              => 'required',
            'category_id'           => 'required',
            'ad_position'           => 'required',
            
        ]);

        if (isset($all['image']))
        {
            $image = $all['image'];
            $imageName = str_replace(' ', '_', time() . '_' . $image->getClientOriginalName());
            $image->move(config('app.gif_img'), $imageName);
            $all['image']                    = $imageName ?? NULL;
        }

        $all['ad_name']                     = ucfirst($all['ad_name']);
        $all['start_date']                  = $new_date_from;
        $all['end_date']                    = $new_date_to;        
        $all['created_at']                  = date('Y-m-d H:i:s');
        $all['updated_at']                  = date('Y-m-d H:i:s');

        

        $result                        = GifAds::findOrFail($id);
        $result->update($all);

        // Redirect to the index page with a success message
        return redirect()->route($this->route.'.index')->with('success', 'Gif updated successfully.');
    }

    public function destroy(GifAds $GifAds)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $GifAds->delete();
        return redirect()->route($this->route.'.index')->with('success', 'Gif deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = GifAds::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
