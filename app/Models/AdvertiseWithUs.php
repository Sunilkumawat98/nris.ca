<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertiseWithUs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table            = 'advertise_with_us';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'business',
        'website',
        'image',
        'message',
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
        return $value ? config('app.image_url').'ADVERTISE_IMAGE/'.$value : null;
    }
} 
