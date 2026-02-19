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

## Deploying (Laravel Cloud)

- **Build & deploy commands:** see **[docs/LARAVEL-CLOUD.md](docs/LARAVEL-CLOUD.md)** (build commands, deploy commands, and why not to run `db:copy-mariadb-to-sqlite` on Cloud).
- **Without a database for posts:** set `POSTS_SOURCE=files` and use Markdown in `resources/posts/`. See **[docs/POSTS-SOURCE.md](docs/POSTS-SOURCE.md)**.
- **Bundled SQLite:** run `db:copy-mariadb-to-sqlite` locally, commit `database/database.sqlite`, then set SQLite in Cloud env. Same doc has details.