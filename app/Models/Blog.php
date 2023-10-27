<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'blogs';

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
        'cat_id',        
        'title',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'admin_id',
        'is_live',
        'created_at',
        'updated_at',
        'status'
    ];


    public function getImageAttribute($value)
    {
        return $value ? config('app.image_url').'BLOG_IMAGE/'.$value : null;
    }

    public function category() {
        return $this->belongsTo(BlogCategory::class, 'cat_id', 'id')->select(['id', 'name']);
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id', 'id')->select(['id', 'name']);
    }

    public function likesCount()
    {
        return $this->hasMany(BlogLike::class)->where('liked', true);
    }

    public function dislikesCount()
    {
        return $this->hasMany(BlogLike::class)->where('liked', false);
    }

    // public function comments() {
    //     return $this->hasMany(BlogComment::class, 'training_list_id', 'id');
    // }


}
