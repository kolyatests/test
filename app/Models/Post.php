<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;


    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function add($field): Post
    {
        $post = new static;
        $post->fill($field);
        $post->save();
        return $post;
    }

    public function edit($field): void
    {
        $this->fill($field);
        $this->save();
    }

    public function remove(): void
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage(): void
    {
        if ($this->image != null) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function uploadImage($image): void
    {
        if (!$image) {
            return;
        }
        $this->removeImage();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->update(['image' => $filename]);
    }

    public function setCategory($id)
    {
        if (!$id) {
            return;
        }
        $this->update(['category_id' => $id]);
    }

    public function getImage()
    {
        if ($this->image == null) {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->image;
    }

}
