# Depois do Save — agent notes

Read **`docs/PROJECT.md`** before changing structure, deploy, or DreamHost paths.

- Production only: branch **`main`** → GitHub Environment **`production`**.
- No staging for this project.
- Do not put secrets in the repo.
- Build output is static (`adapter-static`).
- Keep `.htaccess` in `static/` so SPA deep links work on Apache.
