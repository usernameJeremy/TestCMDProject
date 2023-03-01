<?php

require_once 'vendor/autoload.php';

use App\Application;

$app = new Application('MockData/MOCK_DATA.csv');
$app->run();

