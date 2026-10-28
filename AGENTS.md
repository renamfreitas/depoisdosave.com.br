# Depois do Save — agent notes

Read **`docs/PROJECT.md`** before changing structure, deploy, or DreamHost paths.

- Production only: branch **`main`** → GitHub Environment **`production`**.
- No staging for this project.
- GitHub holds the child theme, not full WordPress.
- Parent theme is **Twenty Twenty-Five** (`twentytwentyfive`). Custom code goes in `depois-do-save-child`.
- Do not put secrets in the repo.
- No `rsync --delete` of the document root.
- Deploy paths mirror this tree under `/home/ursobalu/depoisdosave.com.br/`.
