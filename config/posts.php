<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post source
    |--------------------------------------------------------------------------
    |
    | "database" = posts from MariaDB/MySQL/SQLite (Eloquent).
    | "files"    = posts from Markdown files in the path below (read-only, no DB).
    | Use "files" for Laravel Cloud / static-style deployments.
    |
    */
    'source' => env('POSTS_SOURCE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Path to Markdown posts (when source = files)
    |--------------------------------------------------------------------------
    */
    'path' => resource_path('posts'),

];
