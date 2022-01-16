# GTMCAshuraDemo
A simple demo project, tutored by Ashura. 🙏

## Installation
```bash
$ php artisan migrate
$ php artisan admin:install
$ php artisan db:seed --class=AdminMenuSeeder
```

After installed, open `<project-url>/admin` in your browser and use username `admin` and password `admin` to login.

## Models

### Category/Post
> - \* <-> \* Post/Category
> - 1 -> \* CategoryTranslation/PostTranslation
> - (by `locale`) 1 -> 1 CategoryTranslation/PostTranslation
- slug
- name
- description
- enabled

### CategoryTranslation/PostTranslation
> - 1 -> 1 Category/Post
- category_id
- locale (en, zhtw, es, ...)
- name
- description
- active
