<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesiMovie extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'desi_movies';

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
        'country_id',
        'state_id',
        'city_id',
        'address',
        'name',
        'slug',
        'description',
        'url',
        'image',
        'start_date',
        'end_date',
        'additional_info',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    public function getImageAttribute($value)
    {
        return $value ? config('app.clasified_cdn_path') .'DESI_MOVIE_IMAGE/'. $value : null;
    }

    public function getStartDateAttribute($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? date('d/m/Y', strtotime($value)) : null;
    }


    
}
