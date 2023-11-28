<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GifAds extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table            = 'gif_ads';

    protected $fillable = [
        'country_id',
        'state_id',
        'category_id',
        'ad_name',
        'ad_contact',
        'ad_address',
        'amount',
        'ad_position',
        'image',
        'click_url',
        'start_date',
        'end_date',
        'total_views',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $hidden           = [
        'created_at',
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



    public function getImageAttribute($value)
    {
        return $value ? config('app.image_url').'GIF_IMAGE/'.$value : null;
    }
} 
