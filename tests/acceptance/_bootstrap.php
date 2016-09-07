<?php
// Here you can initialize variables that will be available to your tests
include __DIR__.'/../../vendor/autoload.php';
$unitTesting = true;
$testEnvironment = 'testing';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$app->boot();
