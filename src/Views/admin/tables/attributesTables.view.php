<?php $it = $context['app']['it']; ?>
<h1 class="title">Table <?= $context['content'] ==='values' ? 'valeurs (attributs)' : 'attributs'?></h1>

<div class="ongletDisplay">
		<a class="link <?= $context['content'] ==='values' ? 'disabled' : 'active'?>" href="/admin-controls/tables/attributes/">Attributs</a>
		<a class="link <?= $context['content'] ==='values' ? 'active' : 'disabled'?>" href="/admin-controls/tables/values/">Valeurs</a>
</div>


<div class="tableContainer">
    <table class="table">

        <?php 
            if($context['content'] === 'attributes') { ?>
       
                <tr class="tableHeader">
                <td>ID</td>
                <td>Nom de l'attribut</td>
                <td>Modifier</td>
                <td>Supprimer</td>
            <?php
              foreach($context['app']['attributes'] as $attribute){   
            
            ?>
            

            <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
                <td class="tdSize1"><?= $attribute->getId()?></td>
                <td class="tdSize2"><?= $attribute->getName()?></td>
                <td class="tdSize1">
                    <a href="/admin-controls/tables/attributes/update/<?= $attribute->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td class="tdSize1">
                    <a  href="/admin-controls/tables/attributes/delete/<?= $attribute->getId() ?>/" onclick="window.confirm('Voulez-vous vraiment supprimer la catégorie : ')">
                        <i class="bi bi-x-octagon-fill"></i>
                    </a>
                </td>
            </tr>
                <?php
                $it++;
             } 
            } else { ?>

                <tr class="tableHeader">
                <td>ID</td>
                <td>Nom de l'attribut</td>
                <td>Nom de la valeur</td>
                <td>Modifier</td>
                <td>Supprimer</td>

                    <?php
                foreach($context['app']['values'] as $values){   
                    ?> 
                    <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
                <td class="tdSize1"><?= $values->getId()?></td>
                <td class="tdSize2"><?= $values->getAttribute()->getName()?></td>
                <td class="tdSize2"><?= $values->getContent()?></td>
                <td class="tdSize1">
                    <a href="/admin-controls/tables/values/update/<?= $values->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td class="tdSize1">
                    <a  href="/admin-controls/tables/values/delete/<?= $values->getId() ?>/" onclick="window.confirm('Voulez-vous vraiment supprimer la catégorie : ')">
                        <i class="bi bi-x-octagon-fill"></i>
                    </a>
                </td>
            </tr>
           
                    <?php
                    $it++;
                }
            }
            ?>
    
    </table>
</div>

