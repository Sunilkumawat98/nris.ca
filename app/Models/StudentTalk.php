<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTalk extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'student_talk';

    protected $hidden           = [
        'created_by',
        'updated_at',
        'deleted_at',
        'is_live',
        'status'
    ];

    protected $dates            = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $casts            = [
        'created_at'            => "datetime:d-M-Y h:i A",        
        'updated_at'            => "datetime:d-M-Y h:i A",
    ]; 

    protected $fillable         = [        
        'country_id',
        'state_id',
        'cat_id',
        'user_id',
        'university_id',
        'title',
        'email',
        'mobile',
        'address',
        'details',
        'other_details',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }


}
