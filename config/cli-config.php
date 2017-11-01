<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use Core\TablePrefix;
use Doctrine\ORM\Events;

require __DIR__.'/../vendor/autoload.php';


/*
 |==================================================================
 | Environment File
 |==================================================================
 |
 * */
$dotEnv = new Dotenv\Dotenv(__DIR__.'/../');
$dotEnv->load();
/*
 |==================================================================
 | Doctrine Cli Configuration
 |==================================================================
 | Command Line Interface for Doctrine
 |
 * */

$settings = include 'settings.php';

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $settings['doctrine']['meta']['entity_path'],
    $settings['doctrine']['meta']['auto_generate_proxies'],
    $settings['doctrine']['meta']['proxy_dir'],
    $settings['doctrine']['meta']['cache'],
    false
);

//Table Prefix Event Listner
$evm = new EventManager();
$tablePrefix = new TablePrefix(getenv('DB_PREFIX',''));
$evm->addEventListener(Events::loadClassMetadata, $tablePrefix);

$em = EntityManager::create($settings['doctrine']['connection'], $config,$evm);

return ConsoleRunner::createHelperSet($em);
