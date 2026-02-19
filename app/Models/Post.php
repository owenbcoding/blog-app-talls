<?php

namespace App\Models;

use App\Services\PostImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(int $width = 700, int $height = 350): string
    {
        return app(PostImageService::class)->forPost($this, $width, $height);
    }

    public function getContentHtml(): string
    {
        return nl2br(e($this->content));
    }

    public function getExcerpt(int $length = 100): string
    {
        $text = strip_tags($this->content);
        return \Illuminate\Support\Str::limit($text, $length);
    }
}
