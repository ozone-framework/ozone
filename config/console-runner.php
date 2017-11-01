<?php
/*
 |==================================================================
 | Initiate Console runner
 |==================================================================
 |
 * */
use Symfony\Component\Console\Application as ConsoleApplication;

$application = new ConsoleApplication();

$commands = require __DIR__.'/../config/settings.php';

foreach ($commands['commands'] as $command) {
    $application->add($command);
}

$application->run();