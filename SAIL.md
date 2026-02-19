# Running the project with Laravel Sail and pnpm

## Prerequisites

- Docker and Docker Compose
- Composer (for initial install only)

## 1. Install PHP dependencies (so Sail’s Docker context exists)

```bash
composer install
```

## 2. Set Sail user/group (Linux/WSL)

So file permissions match your user inside the container:

```bash
# Append to .env (replace with your ids from: id -u and id -g)
echo "WWWUSER=$(id -u)" >> .env
echo "WWWGROUP=$(id -g)" >> .env
```

Your `.env` is already set for Sail (DB_HOST=mariadb, REDIS_HOST=redis, MAIL_HOST=mailpit).

## 3. Start Sail

From the project root, use either the wrapper script or the Sail binary:

```bash
./sail up -d
# or
./vendor/bin/sail up -d
```

To use `sail` without `./` (e.g. `sail down`, `sail up -d`), add this to `~/.bashrc` or `~/.zshrc`:

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Then from the **project root** you can run:

```bash
sail up -d
sail down
sail ps
sail artisan migrate
sail pnpm run dev
```

## 4. Install pnpm and Node dependencies (inside Sail)

Sail’s container has Node and npm. Enable pnpm with Corepack and install deps:

```bash
./vendor/bin/sail shell
# inside the container:
corepack enable pnpm
pnpm install
exit
```

Or in one shot:

```bash
./vendor/bin/sail exec laravel.test corepack enable pnpm
./vendor/bin/sail pnpm install
```

## 5. Run the app

- App: http://localhost (or `APP_PORT` from `.env`)
- Vite dev server: http://localhost:5173 (or `VITE_PORT` from `.env`)

Start the frontend dev server:

```bash
./vendor/bin/sail pnpm run dev
```

Run migrations (first time or after pull):

```bash
./vendor/bin/sail artisan migrate
```

## Useful Sail commands

| Command | Description |
|--------|-------------|
| `sail up -d` | Start containers in background |
| `sail down` | Stop and remove containers |
| `sail down -v` | Stop containers and remove volumes |
| `sail stop` | Stop containers (keep volumes) |
| `sail shell` | Bash in the app container |
| `sail pnpm install` | Install Node deps with pnpm |
| `sail pnpm run dev` | Run Vite dev server |
| `sail artisan migrate` | Run migrations |
| `sail artisan ...` | Any Artisan command |
| `sail composer ...` | Composer inside container |

## Mailpit (when Sail is running)

- SMTP: localhost:1025  
- Web UI: http://localhost:8025  

## Meilisearch (when Sail is running)

- API: http://localhost:7700  
