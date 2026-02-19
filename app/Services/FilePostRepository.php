<?php

namespace App\Services;

use App\Content\FilePost;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use League\CommonMark\CommonMarkConverter;
use SplFileInfo;

class FilePostRepository
{
    private ?CommonMarkConverter $converter = null;

    public function __construct(
        private string $path,
    ) {}

    public function all(?string $categoryFilter = null): Collection
    {
        $posts = $this->scanAndParse();
        if ($categoryFilter !== null && $categoryFilter !== '') {
            $posts = $posts->filter(fn (FilePost $p) => $p->categoryName === $categoryFilter);
        }
        return $posts->sortByDesc(fn (FilePost $p) => $p->date->timestamp)->values();
    }

    public function findBySlug(string $slug): ?FilePost
    {
        return $this->scanAndParse()->firstWhere('slug', $slug);
    }

    /** @return Collection<int, object{name: string, value: string}> */
    public function getCategories(): Collection
    {
        $names = $this->scanAndParse()
            ->pluck('categoryName')
            ->unique()
            ->filter()
            ->sort()
            ->values();
        return $names->map(fn (string $name) => (object) ['name' => $name, 'value' => $name]);
    }

    private function getConverter(): CommonMarkConverter
    {
        if ($this->converter === null) {
            $this->converter = new CommonMarkConverter();
        }
        return $this->converter;
    }

    private function scanAndParse(): Collection
    {
        $path = $this->path;
        if (! is_dir($path)) {
            return collect();
        }
        $files = collect(array_diff(scandir($path), ['.', '..']))
            ->map(fn (string $name) => new SplFileInfo($path . DIRECTORY_SEPARATOR . $name))
            ->filter(fn (SplFileInfo $f) => $f->isFile() && strtolower($f->getExtension()) === 'md');
        $posts = collect();
        foreach ($files as $file) {
            $post = $this->parseFile($file);
            if ($post !== null) {
                $posts->push($post);
            }
        }
        return $posts;
    }

    private function parseFile(SplFileInfo $file): ?FilePost
    {
        $content = file_get_contents($file->getPathname());
        if ($content === false) {
            return null;
        }
        $frontMatter = [];
        $body = $content;
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)/s', $content, $m)) {
            foreach (explode("\n", trim($m[1])) as $line) {
                if (preg_match('/^([a-zA-Z0-9_]+):\s*(.*)$/', trim($line), $fm)) {
                    $frontMatter[$fm[1]] = trim($fm[2]);
                }
            }
            $body = $m[2];
        }
        $title = $frontMatter['title'] ?? 'Untitled';
        $slug = $frontMatter['slug'] ?? str_replace('.md', '', $file->getFilename());
        $categoryName = $frontMatter['category'] ?? 'Uncategorized';
        $dateStr = $frontMatter['date'] ?? 'today';
        $date = Carbon::parse($dateStr);
        $imageUrl = isset($frontMatter['image_url']) ? trim($frontMatter['image_url']) : null;
        $html = $this->getConverter()->convert($body)->getContent();
        return new FilePost(
            slug: $slug,
            title: $title,
            content: $html,
            categoryName: $categoryName,
            date: $date,
            imageUrlTemplate: $imageUrl,
        );
    }
}
