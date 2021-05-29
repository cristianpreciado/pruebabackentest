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
    if (empty(self::$entityManager)) {
      try {
        $config = Setup::createAnnotationMetadataConfiguration([getcwd() . '/src/model/'], TRUE, NULL, NULL, FALSE);

        // Database connection properties.
        $connectionOptions = [
          'driver' => 'pdo_mysql',
          'host' => 'db',
          'dbname' => 'zinobe',
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