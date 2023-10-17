<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeNewsLetter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table            = 'subscribe_newsletters';

    protected $fillable = [
        'email',
        'is_active',
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

} 
