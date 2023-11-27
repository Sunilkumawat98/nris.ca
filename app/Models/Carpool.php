<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpool extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'carpools';

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
        'end_at'                => "date",
    ];

    protected $fillable         = [        
        'from_country_id',
        'to_country_id',
        'from_state_id',
        'to_state_id',
        'from_city_id',
        'to_city_id',
        'cat_id',
        'user_id',
        'journey_type',
        'contact_name',
        'contact_email',
        'contact_number',
        'contact_address',        
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'flex_date',
        'flex_time',
        'flex_location',
        'total_views',
        'is_live',
        'created_at',
        'updated_at',
        'status'
    ];


    public function category() {
        return $this->belongsTo(CarpoolCategory::class, 'cat_id', 'id')->select(['id', 'name']);
    }


    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'name']);
    }

    public function comments() {
        return $this->hasMany(CarpoolComment::class, 'carpool_id', 'id')->select(['id','carpool_id','user_id','comment']);
    }


}
