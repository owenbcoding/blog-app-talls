# Blog app

Laravel blog app (Tall stack with Breeze, Vite, Tailwind).

## Running with Sail and pnpm

Use Docker via Laravel Sail and pnpm for the frontend. Full steps: **[SAIL.md](SAIL.md)**.

Quick start:

```bash
composer install
./vendor/bin/sail up -d
./vendor/bin/sail exec laravel.test corepack enable pnpm
./vendor/bin/sail pnpm install
./vendor/bin/sail pnpm run dev
./vendor/bin/sail artisan migrate
```

App: http://localhost — Vite: http://localhost:5173

## Deploying without a database (Laravel Cloud)

- **Posts from files:** set `POSTS_SOURCE=files` and add Markdown files to `resources/posts/`. See **[docs/POSTS-SOURCE.md](docs/POSTS-SOURCE.md)**.
- **Bundled SQLite:** run `php artisan db:copy-mariadb-to-sqlite` (with MariaDB in .env), then use SQLite and commit `database/database.sqlite`. Same doc has details.