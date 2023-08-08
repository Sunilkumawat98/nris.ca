<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FreeClassified extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'free_classified';

    protected $hidden           = [
        'updated_at',
        'deleted_at',
        'is_live',
        'display_status',
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
        'end_at'                => "date",
    ];

    protected $fillable         = [        
        'user_id',
        'country_id',
        'state_id',
        'cat_id',
        'sub_cat_id',
        'title',
        'title_slug',
        'message',
        'image',
        'contact_name',
        'contact_email',
        'contact_number',
        'contact_address',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_keywords',
        'other_details',
        'end_at',
        'total_views',
        'is_live',
        'display_status',
        'created_at',
        'updated_at',
        'status'
    ];


    public function getImageAttribute($value)
    {
        return $value ? config('app.clasified_cdn_path').'ADS_IMAGE/'.$value : null;
    }

    public function getEndAtAttribute($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }


    public function country_id() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state_id() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function cat_id() {
        return $this->belongsTo(ClassifiedCategory::class, 'cat_id', 'id');
    }
    
    public function sub_cat_id() {
        return $this->belongsTo(ClassifiedSubCategory::class, 'sub_cat_id', 'id');
    }
    
    public function bids() {
        return $this->hasMany(FreeClassifiedBid::class, 'classified_id', 'id');
    }
    
    public function comments() {
        return $this->hasMany(FreeClassifiedComment::class, 'classified_id', 'id');
    }
}
