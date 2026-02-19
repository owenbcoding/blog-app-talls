<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CopyMariaDBToSqlite extends Command
{
    protected $signature = 'db:copy-mariadb-to-sqlite
                            {--sqlite-path= : Path to the SQLite file (default: database/database.sqlite)}';

    protected $description = 'Copy categories and posts from MariaDB/MySQL into a local SQLite file for bundling (e.g. Laravel Cloud)';

    public function handle(): int
    {
        $sqlitePath = $this->option('sqlite-path') ?? database_path('database.sqlite');
        $sourceConnection = config('database.default');

        $this->info('Source connection: ' . $sourceConnection);
        $this->info('SQLite path: ' . $sqlitePath);

        if (! in_array($sourceConnection, ['mysql', 'mariadb'], true)) {
            $this->error('Default DB connection must be mysql or mariadb. Set DB_CONNECTION=mariadb (or mysql) in .env and try again.');
            return self::FAILURE;
        }

        if (! Schema::connection($sourceConnection)->hasTable('categories') || ! Schema::connection($sourceConnection)->hasTable('posts')) {
            $this->error('Source database must have categories and posts tables.');
            return self::FAILURE;
        }

        $this->ensureSqliteFile($sqlitePath);
        $this->configureSqliteConnection($sqlitePath);
        $this->runMigrationsOnSqlite();
        $this->copyCategories($sourceConnection);
        $this->copyPosts($sourceConnection);

        $this->newLine();
        $this->info('Done. SQLite file: ' . $sqlitePath);
        $this->info('To use it: set DB_CONNECTION=sqlite and DB_DATABASE=' . $sqlitePath . ' (or relative path) in .env');

        return self::SUCCESS;
    }

    private function ensureSqliteFile(string $path): void
    {
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (! file_exists($path)) {
            touch($path);
            $this->info('Created SQLite file.');
        }
    }

    private function configureSqliteConnection(string $path): void
    {
        config(['database.connections.sqlite.database' => $path]);
        DB::purge('sqlite');
    }

    private function runMigrationsOnSqlite(): void
    {
        $this->info('Running migrations on SQLite...');
        $this->call('migrate', ['--database' => 'sqlite', '--force' => true]);
    }

    private function copyCategories(string $sourceConnection): void
    {
        $categories = DB::connection($sourceConnection)->table('categories')->orderBy('id')->get();
        $this->info('Copying ' . $categories->count() . ' categories...');

        $idMap = [];
        foreach ($categories as $cat) {
            $newId = DB::connection('sqlite')->table('categories')->insertGetId([
                'name' => $cat->name,
                'created_at' => $cat->created_at,
                'updated_at' => $cat->updated_at,
            ]);
            $idMap[(int) $cat->id] = $newId;
        }
        cache()->put('db:copy-category-id-map', $idMap, now()->addMinutes(5));
    }

    private function copyPosts(string $sourceConnection): void
    {
        $idMap = cache()->get('db:copy-category-id-map', []);
        $posts = DB::connection($sourceConnection)->table('posts')->orderBy('id')->get();
        $this->info('Copying ' . $posts->count() . ' posts...');

        foreach ($posts as $post) {
            $newCategoryId = $idMap[(int) $post->category_id] ?? $post->category_id;
            DB::connection('sqlite')->table('posts')->insert([
                'title' => $post->title,
                'content' => $post->content,
                'category_id' => $newCategoryId,
                'image_url' => $post->image_url ?? null,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
            ]);
        }
        cache()->forget('db:copy-category-id-map');
        $this->newLine();
    }
}
