<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 5/5/17
 * Time: 2:34 PM
 */

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

$dm = $app->getContainer()[\Contract\Container::NAME_DATA_MANAGER];


$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'dm' => new \Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper($dm),
));

$console = new \Symfony\Component\Console\Application('cdn Console ');

$console->setHelperSet($helperSet);

$console->addCommands(array(
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateDocumentsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\CreateCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\DropCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\UpdateCommand(),

));
try {
    $console->run();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
