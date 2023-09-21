<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\University;
use App\Models\StudentTalkCategory;
use App\Models\StudentTalk;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Exception;

class StudentTalkController 
{
    public function __construct()
    {
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
        $this->permission               = 'student_talk';
        $this->route                    = 'student_talk';
        
    }
    
    
    public function index(Request $request)
    {     
        if(!auth()->user()->hasPermission('manage_student_talk'))
        {
            abort(404, 'You are not Authorised...');
        }

        $searchQuery = $request->input('search');
        $results                      = StudentTalk::where('status', 1);
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


    public function show($id)
    {
        // Find the post by its ID and pass it to the view
        $results                        = StudentTalk::findOrFail($id);
        return view('admin.'.$this->route.'.show', compact('results'));
    }

    public function destroy(StudentTalk $studentTalk)
    {
        if(!auth()->user()->hasPermission('delete_'.$this->permission))
        {
            abort(404, 'You are not Authorised...');
        }
        $studentTalk->delete();
        return redirect()->route($this->route.'.index')->with('success', 'Deleted successfully!');
    }

    public function livePause($id)
    {
        // Find the post by ID
        $results = StudentTalk::findOrFail($id);

        // Toggle the status between "pause" and "live"
        $results->is_live = ($results->is_live === 1) ? 0 : 1;
        $results->save();

        return redirect()->route($this->route.'.index')->with('success', 'Live status updated successfully.');
    }
    

    
    
    
}
