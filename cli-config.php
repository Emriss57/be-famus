<?php

require_once(__DIR__ . '/src/Core/Database.php');

$entityManager = (new Database())->getEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

?>