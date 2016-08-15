# Detailed PHPUnit printer - WIP

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
TBD

## License

ISC 

Please see [LICENSE](LICENSE.md) for additional information.