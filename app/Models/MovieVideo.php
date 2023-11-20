<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieVideo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = false;
        
    protected $table            = 'movie_videos';

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
        'category_id',        
        'language_id',        
        'name',
        'link',
        'is_live',
        'created_at',
        'updated_at',
        'status'
    ];
 


    public function category() {
        return $this->belongsTo(MovieVideoCategory::class, 'category_id', 'id')->select(['id', 'name']);
    }

    public function language() {
        return $this->belongsTo(MovieVideoLanguage::class, 'language_id', 'id')->select(['id', 'name']);
    }



    public function likesCount()
    {
        return $this->hasMany(MovieVideoLike::class)->where('liked', true);
    }

    public function dislikesCount()
    {
        return $this->hasMany(MovieVideoLike::class)->where('liked', false);
    }



}
