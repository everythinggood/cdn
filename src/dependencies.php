<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container[\Contract\Container::NAME_VIEW] = function (\Psr\Container\ContainerInterface $c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container[\Contract\Container::NAME_LOGGER] = function (\Psr\Container\ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container[\Contract\Container::NAME_DATA_MANAGER] = function (\Slim\Container $c) {
    $settings = $c->get('settings')['mongodb'];
    $connection = new \Doctrine\MongoDB\Connection($settings['uri']);
    $config = new \Doctrine\ODM\MongoDB\Configuration();

    $config->setProxyDir(__DIR__ . '/../cache/Proxies');
    $config->setProxyNamespace('Proxies');
    $config->setHydratorDir(__DIR__ . '/../cache/Hydrators');
    $config->setHydratorNamespace('Hydrators');
    $config->setDefaultDB($settings['database']);
    $config->setMetadataDriverImpl(\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create(__DIR__ . '/Entity'));

    \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();

    if (is_file(__DIR__ . '/../vendor/autoload.php')) {
        $loader = require __DIR__ . '/../vendor/autoload.php';
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    }

    $dm = \Doctrine\ODM\MongoDB\DocumentManager::create($connection, $config);

    return $dm;
};
