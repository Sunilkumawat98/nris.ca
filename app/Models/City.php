<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'cities';

    protected $hidden           = [
        'country_id',
        'state_id',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_live',
        'created_by',
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
        'country_id',
        'state_id',
        'state_code',
        'created_at',
        'updated_at',
        'deleted_at',
        'is_live',
        'status'
    ];
    
}
