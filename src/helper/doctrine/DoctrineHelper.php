<?php

namespace zinobe\helper\doctrine;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

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
    // Check if manager exists.
    if (empty(self::$entityManager)) {
      try {
        /**
         * Create configurations taking information like:
         *  - Directory of the models.
         *  - If we are on development mode.
         *  - Directory of proxies models.
         *  - Cache directory.
         *  - If simple annotation reader should be used.
         */
        $config = Setup::createAnnotationMetadataConfiguration([getcwd() . '/src/model/'], TRUE, NULL, NULL, FALSE);

        // Database connection properties.
        $connectionOptions = [
          'driver' => 'pdo_mysql',
          'host' => 'db',
          'dbname' => 'customFramework',
          'user' => 'root',
          'password' => '123',
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