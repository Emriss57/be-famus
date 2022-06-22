<?php $it = $context['app']['it']; ?>
<h1 class="title">Table catégories</h1>

<div class="tableContainer">
    <table class="table">
        <tr class="tableHeader">
            <td>ID</td>
            <td>Nom categorie</td>
            <td>Nom sous-categorie</td>
            <td>Modifier</td>
            <td>Supprimer</td>
        </tr>
        <?php 
       
            foreach($context['app']['subCategories'] as $subCategory){ 
        ?>
            <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
                <td class="tdSize1"><?= $subCategory->getId()?></td>
                <td class="tdSize2"><?= $subCategory->getParent()?->getName()?></td>
                <td class="tdSize2"><?= $subCategory->getName()?></td>
                <td class="tdSize1">
                    <a href="/admin-controls/tables/sub-categories/update/<?= (int)$subCategory->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td class="tdSize1">
                    <a  href="/admin-controls/tables/sub-categories/delete/<?= (int)$subCategory->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer la sous-catégorie : <?= $subCategory->getName() ?> qui se trouve dans la catégorie : <?= $subCategory->getParent()->getName() ?> ?')">
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