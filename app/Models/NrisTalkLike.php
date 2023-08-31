<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NrisTalkLike extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;
        
    protected $table            = 'nris_talk_like';

    protected $hidden           = [
        'user_id',
        'country_id',
        'state_id',
        'updated_at',
        'deleted_at',
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
        'talk_id',
        'user_id',
        'country_id',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];
    
}
