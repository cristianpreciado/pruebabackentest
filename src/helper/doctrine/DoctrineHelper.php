<?php

namespace zinobe\helper\doctrine;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

/**
 * Class DoctrineHelper
 * Helper class to work with doctrine. Implements Singleton pattern.
 *
 * @package zinobe\helper\doctrine
 */
class DoctrineHelper {

  /**
   * @var EntityManager
   * Singleton var to avoid multiple EntityManager instances.
   */
  protected static $entityManager = NULL;

  public static function getEntityManager() {
    if (empty(self::$entityManager)) {
      try {
        $config = Setup::createAnnotationMetadataConfiguration([getcwd() . '/src/model/'], TRUE, NULL, NULL, FALSE);
        $dotenv = Dotenv::createImmutable(getcwd());
        $dotenv->load();
        $dotenv->required([
          'MYSQL_HOST',
          'MYSQL_DB',
          'MYSQL_USERNAME',
          'MYSQL_PASSWORD',
      ]);
        // Database connection properties.
        $connectionOptions = [
          'driver' => 'pdo_mysql',
          'host' => $_ENV['MYSQL_HOST'],
          'dbname' => $_ENV['MYSQL_DB'],
          'user' => $_ENV['MYSQL_USERNAME'],
          'password' => $_ENV['MYSQL_PASSWORD'],
        ];
        self::$entityManager = EntityManager::create($connectionOptions, $config);
      } catch (ORMException $e) {
        // we can include any php log for our application.
      }
    }
    return self::$entityManager;
  }

  public static function getRepository($classname) {
    $entityManager = self::getEntityManager();
    return $entityManager->getRepository($classname);
  }
}