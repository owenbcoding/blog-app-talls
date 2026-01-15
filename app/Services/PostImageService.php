<?php

namespace App\Services;

use App\Models\Post;

class PostImageService
{
    public function forPost(Post $post, int $width = 700, int $height = 350): string
    {
        $overrides = config('post_images.overrides', []);
        if (array_key_exists($post->id, $overrides)) {
            return $overrides[$post->id];
        }

        $parts = [];

        if (!empty($post->title)) {
            $parts[] = $post->title;
        }

        if (!empty($post->category?->name)) {
            $parts[] = $post->category->name;
        }

        $query = trim(implode(' ', $parts));
        if ($query === '') {
            $query = config('post_images.fallback_query', 'blog');
        }

        $encodedQuery = rawurlencode($query);

        $base = rtrim(config('post_images.api_base', 'https://source.unsplash.com'), '/');

        return "{$base}/{$width}x{$height}/?{$encodedQuery}";
    }
}
