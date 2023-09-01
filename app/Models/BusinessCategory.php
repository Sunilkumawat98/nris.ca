<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'business_category';

    protected $hidden           = [
        'created_by',
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
        'icon',
        'slug',
        'is_live',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];


    public function getIconAttribute($value)
    {
        return $value ? config('app.clasified_cdn_path') .'BUSINESS_ICON/'. $value : null;
    }


    public function states() {
        return $this->belongsTo(BusinessSubCategory::class, 'category_id', 'id');
    }

    public function category_data()
    {
        return $this->hasMany(BusinessListing::class, 'cat_id');
    }


}
