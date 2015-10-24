<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';

$container = require __DIR__ . '/../../app/FrontModule/bootstrap.php';

$container->getByType('Nette\Application\Application')->run();
