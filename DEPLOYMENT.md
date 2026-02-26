# Laravel 12 on Render (PostgreSQL) – Production Deployment

This guide covers deploying the Laravel 12 app to **Render (free tier)** with **PostgreSQL**, including secure env vars, build/start flow, migrations, caching, storage link, and Vite in production.

---

## 1. Secure environment variable setup

**Never commit `.env` or real secrets.** Configure everything in Render Dashboard → Your Web Service → **Environment**.

### Required variables

| Variable | Where to get / set | Notes |
|----------|--------------------|--------|
| `APP_KEY` | Run locally: `php artisan key:generate --show` | Paste the `base64:...` value. Required for encryption/sessions. |
| `APP_ENV` | Set to `production` | |
| `APP_DEBUG` | Set to `0` | Avoid leaking stack traces. |
| `APP_URL` | Your Render URL, e.g. `https://cafe-system.onrender.com` | No trailing slash. |
| `ASSET_URL` | Same as `APP_URL` | So Vite/asset() use HTTPS (avoids mixed content). |
| `DATABASE_URL` | From Render: add PostgreSQL DB, then use **Internal Database URL** | Link DB to service or paste Internal URL. |
| `DB_CONNECTION` | Set to `pgsql` | So Laravel uses PostgreSQL. |

### Optional (recommended for production)

- `CACHE_STORE=database`  
- `SESSION_DRIVER=database`  
- `QUEUE_CONNECTION=database`  
- `LOG_CHANNEL=stderr`  
- `LOG_LEVEL=warning`

Use **Secret** (lock icon) in Render for `APP_KEY` and any API keys.

Reference: `.env.production.example` (do not commit real values).

---

## 2. Optimized build (Docker)

Render uses the **Dockerfile**; there is no separate “Build Command” to type. The image build does:

1. **Composer**  
   `composer install --no-dev --optimize-autoloader`  
   (no dev deps, faster and smaller).

2. **Node / Vite**  
   - `npm ci` (or `npm install --omit=dev` if no lockfile)  
   - `npm run build`  
   Produces `public/build/` with manifest and hashed assets. No `php artisan serve` or dev server.

3. **Directories**  
   Creates and sets permissions for `storage/` and `bootstrap/cache/`.

Build runs once per deploy. No migrations or cache here (they need runtime env and DB).

---

## 3. Start command and public directory

- **Start command:** Render does **not** run a custom start command for Docker; the container runs the image **CMD**: `/start.sh` (from the base image).

- **Public directory:** The Dockerfile sets  
  `ENV WEBROOT=/var/www/html/public`  
  so Nginx uses Laravel’s `public/` as document root. All HTTP requests go through `public/index.php` (via Nginx try_files). You do **not** use `php artisan serve` in production.

- **Port:** The base image listens on the port Render expects (e.g. 10000); no extra config needed.

---

## 4. Auto migration and startup script

Migrations run at **container startup**, not during the Docker build (DB is not available at build time).

The base image has `RUN_SCRIPTS=1` and runs scripts in `/var/www/html/scripts/` in order. Our script **`scripts/01_laravel.sh`** runs:

- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan storage:link` (idempotent; `|| true` so failure doesn’t block start)
- `php artisan migrate --force`

So every deploy runs migrations automatically after the new container starts.

---

## 5. Storage linking

- **In startup:** `scripts/01_laravel.sh` runs `php artisan storage:link`, creating `public/storage` → `storage/app/public`.
- **On Render free tier:** Disk is ephemeral; uploads are lost on redeploy. For persistent files use an external store (e.g. S3) and configure `config/filesystems.php` and env (e.g. `FILESYSTEM_DISK=s3`).

---

## 6. Config, route, and view caching

All done in **`scripts/01_laravel.sh`** at startup:

- `config:cache` – writes `bootstrap/cache/config.php` (reads env at startup).
- `route:cache` – writes `bootstrap/cache/routes-v7.php`.
- `view:cache` – compiles Blade views.

After this, Laravel uses these caches until the next deploy. Do **not** run `config:cache` at Docker build time (env is not available then).

---

## 7. Vite in production (build and serve)

- **Build:** During Docker build, `npm run build` runs Vite and outputs to `public/build/` (manifest + hashed JS/CSS). No Vite dev server in production.
- **Serve:** Nginx serves `public/` (including `public/build/`). Laravel’s `@vite(['resources/css/app.css', 'resources/js/app.js'])` reads `public/build/manifest.json` and outputs the correct script/link tags.
- **HTTPS:** Set `ASSET_URL` (and `APP_URL`) to your `https://...` Render URL so asset URLs are HTTPS and you avoid mixed content.

If the page loads but CSS/JS are missing, check:

- `APP_URL` and `ASSET_URL` are correct and HTTPS.
- Build completed and `public/build/manifest.json` exists in the image (check build logs).

---

## 8. Troubleshooting 500 errors

### 8.1 Check logs

- Render Dashboard → Your Web Service → **Logs** (including “Deploy logs” and “Service logs”).
- Laravel logs to stderr (`LOG_CHANNEL=stderr`), so errors appear in Render logs.

### 8.2 Common causes and fixes

| Symptom / cause | What to do |
|-----------------|------------|
| **APP_KEY not set** | Set `APP_KEY` in Environment (from `php artisan key:generate --show`). |
| **Database connection failed** | Ensure PostgreSQL is created and **Internal Database URL** is set as `DATABASE_URL`; set `DB_CONNECTION=pgsql`. |
| **Permission denied (storage/bootstrap/cache)** | Startup script and Dockerfile set 775 on `storage/` and `bootstrap/cache`. If you changed user, ensure the process can write there. |
| **Config/cache stale** | Redeploy so `01_laravel.sh` runs again (config/route/view cache is regenerated). |
| **Class or autoload not found** | Rebuild image (Composer autoload is built into the image). |
| **Mixed content (HTTPS page, HTTP assets)** | Set `ASSET_URL` and `APP_URL` to `https://...`. |
| **Route or view not found after deploy** | Ensure `route:cache` and `view:cache` run (they do in `01_laravel.sh`). Clear cache only for debugging; normally redeploy. |

### 8.3 Quick debug (temporarily)

- Set `APP_DEBUG=1` and redeploy to see Laravel’s error page (only for short-term debug; set back to `0` and redeploy).
- Inspect “Service logs” for PHP errors and stack traces.

### 8.4 Health check

Laravel’s `/up` route is used for health checks. Ensure it’s not disabled and returns 200 when the app is healthy.

---

## 9. Step-by-step deployment checklist

1. **PostgreSQL**  
   Render Dashboard → New → PostgreSQL → Create. Copy **Internal Database URL**.

2. **Web Service**  
   New → Web Service → Connect repo → Select this repo.

3. **Runtime**  
   Choose **Docker** (Dockerfile path: `./Dockerfile`).

4. **Environment**  
   Add all variables from the table in §1 (especially `APP_KEY`, `APP_URL`, `ASSET_URL`, `DATABASE_URL`, `DB_CONNECTION`). Use Internal URL for `DATABASE_URL`.

5. **Deploy**  
   Save; Render builds the Docker image (Composer + Vite build) and starts the container. Startup script runs migrations and caches.

6. **Verify**  
   Open `https://your-service.onrender.com` and check assets and one or two pages. Check Logs for any PHP/Laravel errors.

---

## 10. Summary

- **Env:** Set in Render only; use `.env.production.example` as reference; never commit secrets.
- **Build:** Dockerfile runs Composer and `npm run build` (Vite); no `php artisan serve`.
- **Start:** Container runs base image `/start.sh`; Nginx uses `public/` as document root.
- **Migrations:** Run automatically in `scripts/01_laravel.sh` on each deploy.
- **Caching:** Config, route, and view cache run in the same script.
- **Storage:** `storage:link` runs at startup; for persistence use S3 or similar.
- **Vite:** Built at image build time; served from `public/build/`; set `ASSET_URL` for HTTPS.
- **500s:** Check Render logs, `APP_KEY`, `DATABASE_URL`, permissions, and `ASSET_URL`/`APP_URL` as above.
