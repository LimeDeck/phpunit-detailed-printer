# 📋 Detailed PHPUnit Printer

[![Build Status](https://travis-ci.org/LimeDeck/phpunit-detailed-printer.svg?branch=master)](https://travis-ci.org/LimeDeck/phpunit-detailed-printer)
[![GitHub release](https://img.shields.io/github/release/LimeDeck/phpunit-detailed-printer.svg)](https://github.com/limedeck/phpunit-detailed-printer)

## Installation

`composer require limedeck/phpunit-detailed-printer`

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

## License

Detailed PHPUnit Printer is open-sourced software licensed under the ISC license. If you'd like to read the license agreement, click [here](LICENSE.md).
