<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'meta_title',
        'meta_description',
        'title',
        'slug',
        'excerpt',
        'image',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class, 'categories_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopesearch($query, $title){
        return $query->where(function ($subquery) use ($title){
            if(!is_null($title) && strlen($title) > 0)
                $subquery->where('title', 'LIKE', '%'.$title.'%');
        })
        ->orderBy('title', 'DESC');
    }
}
