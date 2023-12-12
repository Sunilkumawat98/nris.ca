<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'forums';

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
        'user_id',
        'cat_id',
        'sub_cat_id',        
        'title',
        'title_slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'display_status',
        'total_views',
        'is_live',
        'created_at',
        'updated_at',
        'status'
    ];


    public function category() {
        return $this->belongsTo(ForumCategory::class, 'cat_id', 'id')->select(['id', 'name']);
    }

    public function subcategory() {
        return $this->belongsTo(ForumSubCategory::class, 'cat_id', 'id')->select(['id', 'name']);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'first_name', 'last_name']);
    }

    public function comments() {
        return $this->hasMany(ForumComment::class, 'forum_id', 'id')->select(['id','forum_id','user_id','comment']);
    }

}
