<?php

namespace LimeDeck\Testing;

use PHPUnit\Runner\Extension\Facade;
use PHPUnit\TextUI\Configuration\Configuration;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\Runner\Extension\Extension as PhpunitExtension;

final class Extension implements PhpunitExtension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        if ($configuration->noOutput()
            || $configuration->noProgress()
            || $configuration->outputIsTeamCity()
            || $configuration->debug()) {
            return;
        }

        $facade->replaceProgressOutput();

        $facade->registerTracer(new Printer(
            fopen($configuration->outputToStandardErrorStream() ? 'php://stderr' : 'php://stdout', 'wb'),
            $configuration->colors(),
            $configuration->source(),
        ));
    }
}
