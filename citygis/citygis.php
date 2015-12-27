<?php

/**
 * Created by PhpStorm.
 * User: nav
 * Date: 14-12-15
 * Time: 04:26
 *
 * php app/console genereer:events
 * php app/console genereer:positions
 */
require __DIR__.'/vendor/autoload.php';

use AppBundle\Command\EventsCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new EventsCommand());
$application->run();
