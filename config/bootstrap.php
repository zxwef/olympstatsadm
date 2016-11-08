<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
//use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once __DIR__.'/doctrine-config.php';

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../entities"), DEV_MODE, null, null, false);
$entityManager = EntityManager::create($conn, $config);

$cnn = $entityManager->getConnection();
$cnn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
