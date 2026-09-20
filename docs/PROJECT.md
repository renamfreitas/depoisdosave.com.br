# Depois do Save — project brief

Working context for Depois do Save on DreamHost shared hosting and this repository.

Public production: [https://depoisdosave.com.br](https://depoisdosave.com.br)

## Hosting snapshot

| Item | Production |
| --- | --- |
| Branch | `main` |
| GitHub Environment | `production` |
| Site | `depoisdosave.com.br` |
| Document root | `/home/ursobalu/depoisdosave.com.br` |
| SSH host | `pdx1-shared-a1-42.dreamhost.com` |
| Shell user | `ursobalu` |
| App type | SvelteKit → **static SPA** (`@sveltejs/adapter-static`) |

Same DreamHost account/user as Stickman; only the deploy path differs.

No staging environment for this project.

## Flow

```
Cursor → Git → GitHub (main)
  → GitHub Actions (environment production)
  → SSH + rsync build/
  → DreamHost → depoisdosave.com.br
```

- GitHub is the source of truth for versioned code.
- DreamHost serves the built static files; do not edit live files as the primary workflow.

## Repository layout (relevant)

```
src/                 # SvelteKit app
static/              # Copied into build (includes .htaccess for SPA routes)
build/               # Output of npm run build (gitignored; what CI deploys)
.github/workflows/deploy.yml
docs/PROJECT.md
```

## CI/CD

- Workflow: `.github/workflows/deploy.yml`
- Push / `workflow_dispatch` on **`main`** → Environment **`production`**
- Steps: `npm ci` → `npm run build` → SSH + `rsync` of `build/` to `DEPLOY_PATH`
- Uses `--delete` so stale hashed assets disappear (safe: document root is this app only)
- Excludes `.well-known` (Let’s Encrypt / panel files on DreamHost)

### GitHub Environment `production`

| Type | Name | Value |
| --- | --- | --- |
| Variable | `DEPLOY_HOST` | `pdx1-shared-a1-42.dreamhost.com` |
| Variable | `DEPLOY_USER` | `ursobalu` |
| Variable | `DEPLOY_PATH` | `/home/ursobalu/depoisdosave.com.br` |
| Variable | `DEPLOY_PORT` | `22` |
| Variable | `SSH_KNOWN_HOSTS` | output of `ssh-keyscan -H pdx1-shared-a1-42.dreamhost.com` |
| Secret | `SSH_PRIVATE_KEY` | deploy key PEM authorized for `ursobalu` |

Confirm in the DreamHost panel that the site document root is `/home/ursobalu/depoisdosave.com.br` (adjust `DEPLOY_PATH` if the panel shows another folder).

Do not put the private key or DreamHost password in the repo.

## Local build check

```bash
npm ci
npm run build
npm run preview
```

Output must land in `build/` (including `.htaccess`).

## Principles

- Prefer simple, maintainable solutions (static hosting, no Node on shared).
- No secrets in the repo.
- Code and commits in English; conversation with the maintainer may be in Portuguese.
