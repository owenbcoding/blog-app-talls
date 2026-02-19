# Laravel Cloud – Build & Deploy

## Build commands

Use this in **Settings → Deployments → Build commands**:

```bash
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
npm ci
npm run build
```

- Do **not** add `@rollup/rollup-linux-x64-gnu` to `package.json`; the build runs on **ARM64**, and Rollup will install the correct optional binary for the platform.
- If you use **pnpm** instead of npm, use: `pnpm install --frozen-lockfile` and `pnpm run build` (and ensure the lockfile is committed).

## Deploy commands

Use this in **Settings → Deployments → Deploy commands**:

**Option A – Read-only blog (no database for posts)**

Set `POSTS_SOURCE=files` in Environment variables. Then:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

No `migrate` or `db:copy-mariadb-to-sqlite` – posts come from `resources/posts/*.md`.

**Option B – Bundled SQLite (DB in repo)**

If you committed `database/database.sqlite` and set `DB_CONNECTION=sqlite` and `DB_DATABASE` in Environment:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Again, do **not** run `db:copy-mariadb-to-sqlite` on Cloud – there is no MariaDB. That command is for running **locally** to generate the SQLite file, then you commit it and deploy.

**Option C – Managed database (e.g. PlanetScale, Cloud MySQL)**

If you attached a real database and set `DB_*` in Environment:

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Summary

| Mistake | Fix |
|--------|-----|
| Build fails with `EBADPLATFORM` for `@rollup/rollup-linux-x64-gnu` | Remove that package from `package.json`; Rollup will use the right binary for ARM64. |
| Deploy runs `db:copy-mariadb-to-sqlite` | Remove it from Deploy commands. Use it only locally, then commit the SQLite file, or use `POSTS_SOURCE=files`. |
