<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingPlacement extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'training_placements';

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
        'country_id',
        'state_id',
        'cat_id',
        'user_id',
        'admin_id',
        'title',
        'slug',
        'description',
        'image',
        'expire_at',
        'total_views',
        'is_live',
        'created_at',
        'updated_at',
        'status'
    ];


    public function getImageAttribute($value)
    {
        return $value ? config('app.image_url').'TRAINING_IMAGE/'.$value : null;
    }

    public function country_id() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state_id() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }


    public function cat_id() {
        return $this->belongsTo(TrainingPlacementCategory::class, 'cat_id', 'id');
    }

    public function comments() {
        return $this->hasMany(TrainingPlacementComment::class, 'training_list_id', 'id');
    }


}
