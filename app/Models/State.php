<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;
        
    protected $table            = 'states';

    protected $hidden           = [
        'country_id',
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

    protected $fillable         = [        
        'name',
        'code',
        'domain',
        'country_id',
        'description',
        'logo',
        's_meta_title',
        's_meta_description',
        's_meta_keywords',
        'header_image',
        'header_image2',
        'header_image3',
        'created_by',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function cities() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    
}
