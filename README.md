# 📋 Detailed PHPUnit Printer

[![Build Status: Linux](https://travis-ci.org/LimeDeck/phpunit-detailed-printer.svg?branch=master)](https://travis-ci.org/LimeDeck/phpunit-detailed-printer)
[![Build status: Windows](https://ci.appveyor.com/api/projects/status/656nmj6oxbnq4sri/branch/master?svg=true)](https://ci.appveyor.com/project/HRcc/phpunit-detailed-printer/branch/master)
[![GitHub release](https://img.shields.io/github/release/LimeDeck/phpunit-detailed-printer.svg)](https://github.com/limedeck/phpunit-detailed-printer)

## Installation

**For PHPUnit < 6.0, use package version ^2.0.0**

`composer require limedeck/phpunit-detailed-printer --dev`

This is what you get:

![detailed-printer](http://image.prntscr.com/image/c16bd3bae31840b0aaa849812eff141b.png "PHPUnit output with this printer.")

## Usage

Set the printer class in `phpunit.xml`

```
<?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         ...
         printerClass="LimeDeck\Testing\Printer"
         ...
         >
```

## Tests
To run the test suite, use `phpunit` command.

## Contributing
Thanks for your interest in PHPUnit Detailed Printer! If you'd like to contribute, please read our [contributing guide](CONTRIBUTING.md).

## License

Detailed PHPUnit Printer is open-sourced software licensed under the ISC license. If you'd like to read the license agreement, click [here](LICENSE.md).
