<?php
    require_once(__DIR__ . '/../Core/Database.php');
    require_once(__DIR__ . '/../Models/Categories.php');


    $entityManager = (new Database())->getEntityManager();

    $categories = [
        'femme',
        'curvy',
        'homme',
        'enfants'
    ];
    $sous_categories = [
        'promos',
        'vêtements',
        'robes',
        'vêtements de plage'
    ];
    $sous_categories2 = [
        'promos',
        'vêtements',
        'robes',
        'tops',
        'pantalons & jupes'
    ];

    $max = sizeof($categories);
    $i = 0;
    for($i = 0; $i < $max; $i++) {
        $categorie = new Categories();
        $categorie->setName($categories[$i]);
        $entityManager->persist($categorie);
        $entityManager->flush();
    }
    // $max = sizeof($sous_categories);
    // for($j = 0; $j < $max; $j++) {
    //     $sous_categorie = new Categories();
    //     $sous_categorie->setName($sous_categories[$j]);
    //     $sous_categorie->setParent(1);
    //     $entityManager->persist($sous_categorie);
    //     $entityManager->flush();
    // }
    // $max = sizeof($sous_categories2);
    // for($c = 0; $c < $max; $c++) {
    //     $sous_categorie2 = new Categories();
    //     $sous_categorie2->setName($sous_categories2[$c]);
    //     $sous_categorie2->setParent(2);
    //     $entityManager->persist($sous_categorie2);
    //     $entityManager->flush();
    // }
?>