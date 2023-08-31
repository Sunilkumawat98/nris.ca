<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NrisTalk extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;
        
    protected $table            = 'nris_talk';

    protected $hidden           = [
        'country_id',
        'state_id',
        'user_id',
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
        'title',
        'title-slug',
        'description',
        'country_id',
        'state_id',
        'user_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'total_views',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function comments() {
        return $this->hasMany(NrisTalkReply::class, 'talk_id', 'id');
    }

    public function likes() {
        return $this->hasMany(NrisTalkLike::class, 'talk_id', 'id');
    }


    
}
