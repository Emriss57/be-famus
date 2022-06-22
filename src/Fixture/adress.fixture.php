<?php
   require_once(__DIR__ . '/../Core/Database.php');
   require_once(__DIR__ . '/../Models/Address.php');
   require_once(__DIR__ . '/../Models/Users.php');
   require_once(__DIR__ . '/../Models/Roles.php');
   require_once(__DIR__ . '/../Models/Basket.php');
   
       $entityManager = (new Database())->getEntityManager();
       $adresse = new Adresses();
        $user = $entityManager->getRepository('Users')->findOneBy(['id' => 1]);
   
       $adresse->setLine('rue du Jardin', 1);
       $adresse->setPostalCode('57000');
       $adresse->setCity('Metz');
       $adresse->setUser($user);
       
       $entityManager->persist($adresse);
       $entityManager->flush();


  


