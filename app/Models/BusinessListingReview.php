<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessListingReview extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'business_listing_reviews';

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
        'user_id',
        'business_list_id',
        'country_id',
        'state_id',
        'rating',
        'comment',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
