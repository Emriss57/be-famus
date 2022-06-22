<?php $it = $context['app']['it']; ?>
<h1 class="title">Table catégories</h1>

<div class="tableContainer">
    <table class="table">
        <tr class="tableHeader">
            <td>ID</td>
            <td>Nom</td>
            <td>Modifier</td>
            <td>Supprimer</td>
        </tr>
        <?php 
            foreach($context['app']['categories'] as $category){ 
    
          
        ?>
        
            <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
                <td class="tdSize1"><?= $category->getId()?></td>
                <td class="tdSize2"><?= $category->getName()?></td>
                <td class="tdSize1">
                    <a href="/admin-controls/tables/categories/update/<?= $category->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td class="tdSize1">
                    <a  href="/admin-controls/tables/categories/delete/<?= $category->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer la catégorie : <?= $category->getName() ?> ? Tous les produits associées à cette catégories seront supprimées !')">
                        <i class="bi bi-x-octagon-fill"></i>
                    </a>
                </td>
            </tr>
        <?php
                $it++;
             } 
        ?>
    
    </table>
</div>