<?php 

require_once(__DIR__ . '/../Core/Database.php');
require_once(__DIR__ . '/../Models/Attributes.php');
require_once(__DIR__ . '/../Models/AttrValues.php');
require_once(__DIR__ . '/../Models/Products.php');

$attributeArray = [
    'Matière',
    'Taille',
    'Couleur'
    
];


    $entityManager = (new Database())->getEntityManager();

    foreach($attributeArray as $attribute) {
       $attributes = new Attributes();  
       $attributes->setName($attribute);
       $entityManager->persist($attributes); 
    }
    $entityManager->flush();

?>