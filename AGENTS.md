# AGENTS.md

PHP library: a PHPUnit extension that replaces the progress dots with one detailed line per test. Published on Packagist as `limedeck/phpunit-detailed-printer`.

## Commands

```sh
composer install
vendor/bin/phpunit   # run the test suite
composer cs:check    # check code style
composer cs:fix      # fix code style
```

## Layout

- `src/`: the library (`LimeDeck\Testing\`, PSR-4).
- `tests/*.phpt`: end-to-end tests. Each one runs PHPUnit with the printer on a fixture from `tests/_files/` and compares the printed output with its `--EXPECTF--` section.
- `tests/_files/`: fixture tests. Some fail on purpose, so do not "fix" them.

## Rules

- Support every PHP and PHPUnit version that `composer.json` allows (PHP 8.1+, PHPUnit 10.5 to 13). Use only PHPUnit APIs that exist in all of them. Guard a newer API with `method_exists()`, as `src/Extension.php` does.
- Do not add runtime dependencies. Users install this package in their own projects.
- When the printed output changes, update the matching `--EXPECTF--` blocks. Do not loosen them with `%s` to make a test pass.
- Run `vendor/bin/phpunit` and `composer cs:check` before you finish. CI runs the full PHP and PHPUnit matrix.
- Do not edit `composer.lock` by hand.
