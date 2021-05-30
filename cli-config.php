<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use zinobe\helper\doctrine\DoctrineHelper;


$entityManager = DoctrineHelper::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);