# Release Split Checklist

## Goal
- Keep one code line for production (`main` -> `feature/*`).
- Keep local environment settings out of production commits.

## Current Working Rule
- Branch for this cleanup: `chore/local-prod-separation-20260428`
- Do **not** commit local-only files.

## Local-Only Files (do not commit)
- `docker-compose.override.yml`
- `.env.local`
- `bootstrap-local.ps1`
- `docker/mysql/init/*.sql` (only for local bootstrap)
- `agent-last-error.html`

## Production Candidate Files (commit candidates)
- `www/fuel/app/classes/**`
- `www/fuel/app/config/**`
- `www/fuel/app/views/**`
- `www/fuel/core/bootstrap.php`
- `www/fuel/core/classes/error.php`
- `www/fuel/core/classes/presenter.php`
- `www/fuel/core/classes/view.php`
- `www/fuel/core/classes/theme.php`
- `www/htdocs/.htaccess`
- `www/htdocs/index.php`

## Pre-Commit Checks
1. `git status --short`
2. Confirm no local-only files are staged.
3. Confirm no credentials/host-specific hardcoding for local only.

## Suggested Commit Split
1. **Runtime/compatibility fixes** (Fuel + PHP7.4 compatibility, error handler fixes)
2. **Routing/base_url fixes** (login/action URLs and redirect behavior)
3. **Input data dummy/validation behavior** (local test helper behavior, if production-safe)
4. **Docker/local setup docs only** (optional, separate commit or keep uncommitted)
