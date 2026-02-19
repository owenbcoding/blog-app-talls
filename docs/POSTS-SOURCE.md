# Post sources: database vs files

The blog can run in two modes so you can deploy **without a database** (e.g. on Laravel Cloud).

---

## 1. Posts from Markdown files (no DB)

Set in `.env`:

```env
POSTS_SOURCE=files
```

- Posts are read from **`resources/posts/*.md`**.
- Each file has YAML front-matter and Markdown body.

**Front-matter format:**

```yaml
---
title: Your Post Title
slug: your-post-slug
category: Lifestyle
date: 2024-01-15
image_url: https://example.com/image.jpg?w={w}&h={h}
---

Your **Markdown** content here.
```

- **slug** – URL path (e.g. `/post/your-post-slug`). Defaults to filename without `.md`.
- **category** – Used for the sidebar and filtering.
- **image_url** – Optional. Use `{w}` and `{h}` for width/height if the URL supports it.

Add or edit `.md` files in `resources/posts/` and deploy; no database or migrations needed. Best for read-only blogs on Laravel Cloud.

---

## 2. Bundled SQLite (DB in repo, resets on deploy)

Use when you want to keep using the **database** stack but don’t want a separate DB server (e.g. no managed DB on Cloud).

### Step 1 – Copy from MariaDB to SQLite (once, locally)

With `.env` pointing at **MariaDB/MySQL** (e.g. via Sail):

```bash
php artisan db:copy-mariadb-to-sqlite
```

This creates/updates `database/database.sqlite` with your current categories and posts.

### Step 2 – Use SQLite in production

In Laravel Cloud (or your host) set:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

Commit `database/database.sqlite` and deploy. Data will be whatever was in the file at deploy time (no persistence across deploys unless you use a persistent volume).

### Optional – Custom SQLite path

```bash
php artisan db:copy-mariadb-to-sqlite --sqlite-path=/path/to/app.sqlite
```

---

## Summary

| Goal                         | Set                          |
|-----------------------------|------------------------------|
| Read-only blog, no DB       | `POSTS_SOURCE=files`         |
| DB in repo (SQLite bundle)  | Run `db:copy-mariadb-to-sqlite`, then `DB_CONNECTION=sqlite` and commit `database/database.sqlite` |
