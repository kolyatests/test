<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;


    protected $fillable = [
        'title',
        'content',
        'slug',
        'parent_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function remove()
    {
        $this->posts->each->remove();
        $this->delete();
    }

}
