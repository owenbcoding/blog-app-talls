<?php

namespace App\Content;

use Carbon\Carbon;

class FilePost
{
    public function __construct(
        public readonly string $slug,
        public readonly string $title,
        public readonly string $content,
        public readonly string $categoryName,
        public readonly Carbon $date,
        public readonly ?string $imageUrlTemplate = null,
    ) {}

    public function getRouteKey(): string
    {
        return $this->slug;
    }

    public function imageUrl(int $width = 700, int $height = 350): string
    {
        if ($this->imageUrlTemplate !== null) {
            return str_replace(['{w}', '{h}'], [(string) $width, (string) $height], $this->imageUrlTemplate);
        }
        return 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=' . $width . '&h=' . $height . '&fit=crop';
    }

    public function getExcerpt(int $length = 100): string
    {
        $text = strip_tags($this->content);
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '...';
    }

    public function getContentHtml(): string
    {
        return $this->content;
    }
}
