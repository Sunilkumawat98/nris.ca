<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatingSource extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'rating_source';

    protected $hidden           = [
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
        'name',
        'slug',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    
}
