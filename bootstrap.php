<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__ . "/Entity");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'host'     => '127.0.0.1',
    'port'     => 8889,
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'charset'  => 'utf8mb4',
    'password' => 'root',
    'dbname'   => 'ecolidaire',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$config->setProxyDir(__DIR__ . "/Entity/Proxy");
$entityManager = EntityManager::create($dbParams, $config);
