<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:24 PM
 */
require __DIR__.'/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';
/** @var \Doctrine\ODM\MongoDB\DocumentManager $dm */
$dm = $app->getContainer()[\Contract\Container::NAME_DATA_MANAGER];

