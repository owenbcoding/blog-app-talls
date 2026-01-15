<?php

namespace App\Services;

use App\Models\Post;

class PostImageService
{
    public function forPost(Post $post, int $width = 700, int $height = 350): string
    {
        $parts = [];

        if (!empty($post->title)) {
            $parts[] = $post->title;
        }

        if (!empty($post->category?->name)) {
            $parts[] = $post->category->name;
        }

        $query = trim(implode(' ', $parts));
        if ($query === '') {
            $query = 'blog';
        }

        $encodedQuery = rawurlencode($query);

        return "https://source.unsplash.com/{$width}x{$height}/?{$encodedQuery}";
    }
}
