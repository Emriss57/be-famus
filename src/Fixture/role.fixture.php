<?php   

    require_once(__DIR__ . '/../Core/Database.php');
    require_once(__DIR__ . '/../Models/Roles.php');
    
        $entityManager = (new Database())->getEntityManager();
        $role = new Roles();
        $role->setLabel('administrateur');
        $role->setSlug('ROLE_ADMIN');
        $role->setRank('0');
      
        $entityManager->persist($role);
        $entityManager->flush();

        $role = new Roles();
        $role->setLabel('utilisateur');
        $role->setSlug('ROLE_USER');
        $role->setRank('0');
      
        $entityManager->persist($role);
        $entityManager->flush();

        ?>