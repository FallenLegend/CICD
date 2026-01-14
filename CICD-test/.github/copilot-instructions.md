# Copilot Instructions — CICD (Laravel skeleton)

Short, focused guidance to help an AI coding agent be productive in this repository.

- Big picture
  - This is a Laravel application skeleton (Laravel 12, PHP ^8.2). The PHP source lives under `app/` (PSR-4 `App\\`), HTTP entry points and controllers under `app/Http/Controllers`, routes in `routes/`, blade views in `resources/views`, migrations and seeders in `database/` and tests in `tests/`.
  - Front-end is built with Vite + `laravel-vite-plugin` and Tailwind; assets are in `resources/js` and `resources/css` and built via `npm run build`.

- How to run / build / test (explicit commands to use)
  - Install and fully prepare the project: run the composer setup script which sets up env, generates key, migrates and builds frontend:
    - `composer run setup`
  - Development (single-command dev environment - runs server, queue, pail, vite):
    - `composer run dev` (uses `npx concurrently` to launch `php artisan serve`, queue, pail and `npm run dev`).
  - Quick test commands:
    - `composer run test` — runs `php artisan config:clear` then `php artisan test`.
    - You can also run PHPUnit directly (Windows has `vendor\bin\phpunit.bat`) or `vendor/bin/phpunit` from WSL.
  - Frontend:
    - `npm install` then `npm run dev` (dev server) or `npm run build` (production bundle).

- CI / testing specifics (important to emulate locally)
  - `phpunit.xml` is configured to use an in-memory SQLite DB for tests (DB_CONNECTION=sqlite, DB_DATABASE=:memory:). Tests will not require an external DB by default.
  - The composer `post-create-project-cmd` and `scripts.setup` touch `database/database.sqlite` and run migrations — CI may rely on that behavior.

- Project-specific code patterns to know (discoverable in code)
  - Model casts: `app/Models/User.php` declares a typed `protected function casts(): array` instead of the more common `protected $casts = [...]`. When auto-completing or editing models, prefer preserving this pattern.
  - Factories/Seeders:
    - Factories live under `database/factories/` and seeders in `database/seeders/` (`Database\Seeders` namespace mapped in composer.json).
  - Minimal controller base: `app/Http/Controllers/Controller.php` is an empty abstract class — controllers are expected to extend it.

- Where to change common things
  - Routes: modify `routes/web.php` and create route controllers in `app/Http/Controllers`.
  - Views: blade templates in `resources/views/*.blade.php` (the default entry is `welcome.blade.php`).
  - Add Composer deps: update `composer.json` and run `composer install`.
  - Add NPM deps: update `package.json` and run `npm install`.

- Useful files to reference when generating code or tests
  - `composer.json` — runtime and dev dependencies, and helpful scripts (setup, dev, test).
  - `phpunit.xml` — test environment variables (in-memory sqlite, queue/session/mail settings for tests).
  - `routes/web.php`, `app/Models/User.php`, `database/migrations/*`, `database/seeders/DatabaseSeeder.php`, `resources/views/welcome.blade.php`, `tests/`.

- Conventions and safety checks for edits
  - Preserve PSR-4 namespaces: `App\` → `app/`.
  - Keep `php` version compatibility >= 8.2 and avoid syntax requiring newer PHP.
  - Migration filenames here begin with `0001_01_01_000000_...` — follow timestamp pattern when adding migrations using `php artisan make:migration`.
  - Tests rely on environment vars in `phpunit.xml`; when creating tests, do not rely on an external DB unless the test sets it explicitly.

- Quick examples
  - To add a route that returns a view: modify `routes/web.php` (already uses `return view('welcome')`).
  - To run a single PHPUnit test file: `vendor\bin\phpunit.bat tests\Feature\ExampleTest.php` on Windows.

If any of these areas are incomplete or you want more detail (CI YAML examples, common code snippets, or test-writing patterns used in this repo), tell me which section to expand and I'll update this file.