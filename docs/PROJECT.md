# Depois do Save — project brief

Working context for [depoisdosave.com.br](https://depoisdosave.com.br) (DreamHost shared hosting) and this repository.

## Production snapshot

| Item | Value |
| --- | --- |
| SSH host | `pdx1-shared-a1-42.dreamhost.com` |
| Shell user | `ursobalu` |
| Document root | `/home/ursobalu/depoisdosave.com.br` |
| WordPress | Installed on the server (not in Git) |
| Active parent theme | Twenty Twenty-Five (`twentytwentyfive`) |
| Child theme | `wp-content/themes/depois-do-save-child` (deployed via CI) |

Same DreamHost account/user as Casal Gamer; only the deploy path differs.

No staging environment for this project.

## Flow

```
Cursor → Git → GitHub (main)
  → GitHub Actions (environment production)
  → SSH + rsync of the child theme
  → DreamHost → depoisdosave.com.br
```

- GitHub is the source of truth for versioned code.
- DreamHost is the runtime. Do not edit live files as the primary workflow.

## Repository layout

Paths mirror production `wp-content` so rsync can be path-scoped:

```
wp-content/themes/depois-do-save-child/
docs/
AGENTS.md
```

| Package | Role |
| --- | --- |
| `depois-do-save-child` | Appearance on top of Twenty Twenty-Five: CSS, `theme.json`, template overrides, presentation-related PHP. Parent folder: `twentytwentyfive`. |

Twenty Twenty-Five is a block theme. Day-to-day layout, colors, and templates edited in the Site Editor are stored in the database, not in this repo. Put code that must survive a parent update in the child theme.

## What belongs in Git

**Keep out**

- WordPress core (`wp-admin`, `wp-includes`, …)
- The parent theme and other bundled themes (`twentytwentyfive`, …)
- Third-party plugins
- `wp-content/uploads`, cache, logs, backups, database dumps
- `wp-config.php`, passwords, application passwords, SSH keys, any secrets

**Keep in**

- The Depois do Save child theme, docs, and the GitHub Actions workflow

## Theme strategy

- Keep Twenty Twenty-Five as the parent. It ships with WordPress and receives automatic updates from wordpress.org.
- The child `style.css` header must stay `Template: twentytwentyfive`.
- Do not copy the parent into Git or into the child.
- Turn on automatic updates for WordPress core and for Twenty Twenty-Five in wp-admin. A manual install is not updated by the DreamHost one-click updater.

## CI/CD

- Workflow: `.github/workflows/deploy.yml`
- Push / `workflow_dispatch` on **`main`** → GitHub Environment **`production`**
- SSH + `rsync` of the child theme only (no `--delete`):

  - `wp-content/themes/depois-do-save-child/`

### GitHub Environment `production`

| Type | Name | Value |
| --- | --- | --- |
| Variable | `DEPLOY_HOST` | `pdx1-shared-a1-42.dreamhost.com` |
| Variable | `DEPLOY_USER` | `ursobalu` |
| Variable | `DEPLOY_PATH` | `/home/ursobalu/depoisdosave.com.br` |
| Variable | `DEPLOY_PORT` | `22` |
| Variable | `SSH_KNOWN_HOSTS` | output of `ssh-keyscan -H pdx1-shared-a1-42.dreamhost.com` |
| Secret | `SSH_PRIVATE_KEY` | deploy key PEM authorized for `ursobalu` |

Do not put the private key, DreamHost password, or `wp-config` values in the repo.

## After the first deploy

In **Aparência → Temas**, activate **Depois do Save Child**. Twenty Twenty-Five must stay installed; WordPress loads it as the parent.

## Principles

- Prefer simple, maintainable solutions.
- No secrets in the repo.
- No `rsync --delete` of the document root. That would remove WordPress.
- Code and commits in English; conversation with the maintainer may be in Portuguese.
