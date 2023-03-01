<?php

require_once 'vendor/autoload.php'; // Include Composer's autoloader

use App\Application;

$app = new Application('path/to/subscriptions.csv');
$app->run();

