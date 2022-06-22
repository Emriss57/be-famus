<?php

use Doctrine\DBAL\Driver\Exception as PDONonUniqueValue;




    require_once(__DIR__ . '/../Core/Database.php');
    require_once(__DIR__ . '/../Models/Users.php');
    require_once(__DIR__ . '/../Models/Roles.php');
    require_once(__DIR__ . '/../Models/Address.php');
    require_once(__DIR__ . '/../Models/Basket.php');
  
    
    $entityManager = (new Database())->getEntityManager();
    $roles = $entityManager->getRepository('roles')->findOneBy(['id' => 1]);
    

        $salt = [
            'cost' => 12,
        ];
        $pass = 'azertyuiop';
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT,$salt);
        $user = new Users();
        $user->setUsername('administrateur');
        $user->setLastname('Mustafaj');
        $user->setFirstname('Fabrice');
        $user->setEmail('admin@example.com');
        $user->setDateOfBirth('null');
        $user->setProfileImage('/images/profile/unknown/user-avatar.png');
        $user->setPassword($pass_hash);
        $user->setRole($roles);
        $entityManager->persist($user);
        $entityManager->flush();



        $roles = $entityManager->getRepository('roles')->findOneBy(['id' => 2]);

        
        try {
            $salt = [
                'cost' => 12,
            ];
            $pass = 'azertyuiop';
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT,$salt);
            $user = new Users();
            $user->setUsername('utilisateur');
            $user->setLastname('Mustafaj');
            $user->setFirstname('Fabrice');
            $user->setDateOfBirth('null');
            $user->setProfileImage('/images/profile/unknown/user-avatar.png');
            $user->setEmail('user@example.com');
            $user->setPassword($pass_hash);
            $user->setRole($roles);
            $entityManager->persist($user);
            $entityManager->flush(); 
        } catch(PDONonUniqueValue $e) {
            var_dump($e->getMessage());
        }
       
    
    
?>