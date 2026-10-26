# Contributing to PHPUnit Detailed Printer

Thanks for helping improve PHPUnit Detailed Printer. Bug reports, documentation
fixes, tests, and code contributions are welcome.

Please follow the [Code of Conduct](CODE_OF_CONDUCT.md).

## Reporting bugs

Search [existing issues](https://github.com/LimeDeck/phpunit-detailed-printer/issues)
before opening a new one. Include:

- Your PHP, PHPUnit, and phpunit-detailed-printer versions.
- Your operating system and version.
- A minimal test case, relevant PHPUnit configuration, and steps to reproduce.
- The actual output and the output you expected.

Remove credentials and other private information from examples and output.
Report security issues privately as described below.

## Suggesting features

Open an issue before starting a larger feature or refactor. Explain the problem,
your proposed behavior, and an example of the desired output so maintainers can
discuss the approach with you. Small fixes can go straight to a pull request.

## Development setup

Fork the repository, clone your fork, and create a focused branch from `master`.
Run the commands below from the repository root.

The package requires PHP `>=8.3` and supports PHPUnit
`^10.5 || ^11.5 || ^12.5 || ^13.0`, as declared in `composer.json`.
Choose a PHP version compatible with the PHPUnit version you are testing;
the supported test combinations are listed in `.github/workflows/ci.yml`.

Install dependencies, including development tools:

```sh
composer install
```

## Running tests

Run the test suite before submitting a code change:

```sh
vendor/bin/phpunit
```

`phpunit.xml.dist` loads `vendor/autoload.php` and runs the `.phpt` tests in
`tests/`, excluding `tests/_files/`. These tests run PHPUnit against fixtures
and compare the printer output with their `--EXPECTF--` sections.

Add or update tests for behavior changes. When output changes, update the
matching expectations precisely; do not replace them with broad `%s` matches
just to pass. Some fixture tests fail intentionally: preserve that behavior.

Keep changes compatible with every PHP and PHPUnit version allowed by
`composer.json`. CI checks the version matrix, including Windows coverage.

## Coding standards

Follow the existing style and `.php-cs-fixer.dist.php`, which combines Symfony,
PSR-1, and PSR-2 rules with project-specific settings. PHP CS Fixer is a
development dependency. With mise available, check and fix formatting using:

```sh
mise run cs:check
mise run cs:fix
```

These tasks are defined in `mise.toml`; CI runs the style check too.
Review formatting changes before submitting. Do not add runtime dependencies
or edit `composer.lock` by hand.

## Pull request checklist

- Target `master` and keep each pull request to one fix or feature.
- Explain the problem, the resulting behavior, and any related issue.
- Keep commits focused and write clear commit messages.
- Add or update tests for code changes and run the test suite and style check.
- Update `README.md` when usage, configuration, or compatibility changes.
- Make sure CI passes and respond to review feedback.

## Security issues

Do not open a public issue for a suspected vulnerability. Contact the maintainers
privately at [mail@limedeck.io](mailto:mail@limedeck.io), the maintainer address
listed in `composer.json`. Include affected versions, reproduction steps, and
the potential impact without disclosing the report publicly.

## License

By contributing, you agree that your contributions are licensed under the
project's [MIT License](../LICENSE).
