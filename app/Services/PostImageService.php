<?php

namespace App\Services;

use App\Models\Post;

class PostImageService
{
    public function forPost(Post $post, int $width = 700, int $height = 350): string
    {
        // Custom images for specific posts
        $customImages = [
            1 => 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg', // Laravel logo
            2 => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w={w}&h={h}&fit=crop', // Balanced lifestyle - meditation/wellness
            3 => 'https://images.unsplash.com/photo-1528181304800-259b08848526?w={w}&h={h}&fit=crop', // Southeast Asia - Thailand temples
            4 => 'https://images.pexels.com/photos/1437267/pexels-photo-1437267.jpeg?auto=compress&cs=tinysrgb&w={w}&h={h}&fit=crop&q=85', // Fresh pasta
        ];
        
        if (isset($customImages[$post->id])) {
            return str_replace(['{w}', '{h}'], [$width, $height], $customImages[$post->id]);
        }
        
        // Direct coding image URLs that work
        $codingImages = [
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1607799279861-4dd421887fb3?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w={w}&h={h}&fit=crop',
            'https://images.unsplash.com/photo-1534665482403-a909d0d97c67?w={w}&h={h}&fit=crop',
        ];
        
        $index = ($post->id ?? rand(0, 9)) % count($codingImages);
        $url = $codingImages[$index];
        
        return str_replace(['{w}', '{h}'], [$width, $height], $url);
    }
}
