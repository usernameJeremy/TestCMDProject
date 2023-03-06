<?php

require_once __DIR__ . '/composer.phar/vendor/autoload.php';

use App\Application;

$app = new Application('MockData/MOCK_DATA.csv');
$app->run();

