<?php $it = $context['app']['it']; ?>
<h1 class="title">Table produits</h1>




<div class="tableContainer">
    <table class="table">
        <thead>

            <tr class="tableHeader">
                <td>ID</td>
                <td>Nom de la catégorie</td>
                <td>Nom de la sous-catégorie</td>
                <td>Nom du produit</td>
                <td>Description</td>
                <td>Date de création</td>
                <td>Ajouter un produit</td>
                <td>modifier</td>
                <td>Supprimer</td>
                <td>Voir les déclinaisons</td>
            </tr>

        </thead>
        <?php foreach($context['app']['products'] as $product){   
            
            ?>
            
         



            
            <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
                <td><?= $product->getId()?></td>
                <td><?= $product->getCategory()->getParent()->getName()?></td>
                <td><?= $product->getCategory()->getName()?></td>
                <td><?= $product->getName()?></td>
                <td><?= $product->getDescription()?></td>
                <td><?= $product->getCreateDate()?></td>
                <td>
                    <a  href="/admin-controls/tables/products/add/<?= $product->getId() ?>/">
                        <i class="bi bi-plus-square-fill"></i>
                    </a>
                </td>
                <td>
                    <a href="/admin-controls/tables/products/update/<?= $product->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td>
                    <a  href="/admin-controls/tables/products/delete/<?= $product->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer le produit : <?= $product->getName() ?> se trouvant dans la catégorie : <?= $product->getCategory()->getParent()->getName() ?> / <?= $product->getCategory()->getName() ?> ? Attention cela effacera toutes les déclinaisons de produit associées. ')">
                        <i class="bi bi-x-octagon-fill"></i>
                    </a>
                </td>
                
              
                <td>
                    <button class="declineBtn">
                        <i class="bi bi-caret-down-fill"></i>
                    </button>
                </td>
            </tr>
           
      
             
                <tbody class="decline">
                 
                    <tr class="tableHeader">
                        <td>ID</td>
                        <td>Référence</td>
                        <td>Matière</td>
                        <td>Couleur</td>
                        <td>Taille</td>
                        <td>Quantité</td>
                        <td>Prix</td>
                        <td>modifier</td>
                        <td>Supprimer</td>
                        <td></td>
                    </tr>



                
           
                
                    <?php foreach($product->getChildren()->getValues() as $declinedProduct) { ?>
                 
                        <tr>
                            <td><?= $declinedProduct->getId() ?></td>
                            <td><?= $declinedProduct->getReference() ?></td>
                            <?php foreach($declinedProduct->getCaracteristics() as $attribute) { ?>
                                <td><?= preg_match('/^#[0-9a-fA-F]{6}/', $attribute->getContent()) ? '<span class="tableColor" style="background-color:'.$attribute->getContent().'"></span>' : $attribute->getContent()?></td>
                            <?php } ?>
                            <td>x <?= $declinedProduct->getQuantity() ?></td>
                            <td><?= $declinedProduct->getPrice() ?> €</td>
                            <td>
                                <a href="/admin-controls/tables/products/update/<?= $declinedProduct->getId() ?>/">
                                    <i class="bi bi-gear-fill"></i>
                                </a>
                            </td>
                            <td>
                            <a  href="/admin-controls/tables/products/delete/<?= $declinedProduct->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer la déclinaison : <?= $declinedProduct->getReference() ?>')">
                                <i class="bi bi-x-octagon-fill"></i>
                            </a>
                            </td>
                            <td></td>
                        </tr>
                    <?php } ?>
                   
                 
                    </tbody>
                <?php
                
                $it++;
             } ?>
             
   
              
           
    </table>
    
</div>
<div class="pagination">
        <?php foreach(range(1,$context['app']['totalProduct']) as $pagination) { ?>
            <a href="?page=<?= $pagination ?>"><?= $pagination ?></a>
        <?php } ?>
    </div>