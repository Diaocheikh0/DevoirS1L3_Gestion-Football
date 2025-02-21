<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "../vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '../../models'],
    isDevMode: true,
);
// or if you prefer XML
// $config = ORMSetup::createXMLMetadataConfiguration(
//    paths: [__DIR__ . '/config/xml'],
//    isDevMode: true,
//);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver'  => 'pdo_pgsql',
    'user'    => 'postgres',
    'password'=>'Diaoprince30',
    'dbname'  => 'gestion_football1',
    'host'    => '127.0.0.1',
    'port'    => 5432,
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);