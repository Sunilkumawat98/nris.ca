<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;
        
    protected $table            = 'countries';

    protected $hidden           = [
        'created_by',
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
        'color',
        'code',
        'domain',
        'image',
        'c_meta_title',
        'c_meta_description',
        'c_meta_keywords',
        'created_by',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function states() {
        return $this->belongsTo(State::class, 'country_id', 'id');
    }
    
}
