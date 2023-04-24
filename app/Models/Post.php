<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes; // SoftDeletes is used to soft delete the post

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected  $fillable = [
        'meta_title',
        'meta_description',
        'title',
        'slug',
        'excerpt',
        'image',
        'resume',
        'categories_id',
        'author',
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'categories_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopesearch($query, $title){
        return $query->where(function ($subquery) use ($title){
            if(!is_null($title) && strlen($title) > 0)
                $subquery->where('title', 'LIKE', '%'.$title.'%')
                    ->orWhere('author', 'LIKE', '%'.$title.'%');
        })
        ->orderBy('title', 'DESC');
    }


}
