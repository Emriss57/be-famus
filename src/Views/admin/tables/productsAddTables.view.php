<?php $it = $context['app']['it']; ?>
<h1 class="title">Ajouter un produit</h1>
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
        
            
         



            
            <tr class="firstColor">
                <td><?= $context['app']['productToAdd']->getId()?></td>
                <td><?= $context['app']['productToAdd']->getCategory()->getParent()->getName()?></td>
                <td><?= $context['app']['productToAdd']->getCategory()->getName()?></td>
                <td><?= $context['app']['productToAdd']->getName()?></td>
                <td><?= $context['app']['productToAdd']->getDescription()?></td>
                <td><?= $context['app']['productToAdd']->getCreateDate()?></td>
                <td>
                    <a  href="/admin-controls/tables/products/add/<?= $context['app']['productToAdd']->getId() ?>/">
                        <i class="bi bi-plus-square-fill"></i>
                    </a>
                </td>
                <td>
                    <a href="/admin-controls/tables/products/update/<?= $context['app']['productToAdd']->getId() ?>/">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </td>
                <td>
                    <a  href="/admin-controls/tables/products/delete/<?= $context['app']['productToAdd']->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer le produit : <?= $context['app']['productToAdd']->getName() ?>')">
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



                
           
                
                    <?php foreach($context['app']['productToAdd']->getChildren()->getValues() as $declinedProduct) { ?>
                 
                        <tr class="<?= $it % 2 === 0 ?  'firstColor' : 'secondColor' ?> ">
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
                            <a  href="/admin-controls/tables/products/delete/<?= $declinedProduct->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer la déclinaison :  ')">
                                <i class="bi bi-x-octagon-fill"></i>
                            </a>
                            </td>
                            <td></td>
                        </tr>
                    <?php $it++; 
                        } 
                    ?>
                   
                 
                    </tbody>
                
             
   
              
           
    </table>

    <form id="formProductToAdd" class="form">

    <div class="separatorContainer">
       
           
        

        <input id="productId" name="productId" type="hidden" value="<?= $context['app']['productToAdd']->getId() ?>">
        
        
        <label for="price">Prix du produit</label>
        <input id="price" name="price" type="number" placeholder="Entrez le prix du produit" step="0.01" required>
        
        <label for="createdDate">Date de création</label>
        <input id="createdDate" name="createdDate" type="date" min="<?= $context['date']?>" max="<?= $context['date']?>" value="<?= $context['date']?>">
    </div>
    <div class="vl"></div>
    <div class="separatorContainer">
        <?php foreach($context['attributes'] as $attribute) { ?>
            <p class="attributeTitle"><?= $attribute->getName() ?></p>
            <span class="attributeBtn"><i class="bi bi-plus-circle"></i></span>
            <div class="valuesContainer" id="valuesContainer">
                <?php  
                    $attributeValues = $attribute->getValuesAttribute()->getValues();
                        foreach($attributeValues  as $attributeValue){ ?>
                        <div style="background-color:<?= preg_match('/^#[0-9a-fA-F]{6}/',$attributeValue->getContent()) ? $attributeValue->getContent() : 'wheat' ?>">
                        <label class="attributeLabel" for="<?= $attributeValue->getContent() ?>"><?=  preg_match('/^#[0-9a-fA-F]{6}/',$attributeValue->getContent()) ? '' : $attributeValue->getContent() ?></label>
                        <input class="attributeInput" type="checkbox" name="<?= strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e') ?>[]" id='<?= $attributeValue->getContent() ?>' value="<?= $attributeValue->getId() ?>">
                    </div>
                <?php  } ?>
            </div> 
        <?php } ?>
    </div>
    <button name="generateProductToAdd" type="submit" id="submitForm">Générer les produits</button>  





    </form>
    
</div>
<div id="productChecker">
    <a href="/admin-controls/tables/products/add/<?= $context['app']['productToAdd']->getId() ?>/" id="removeProduct">Annuler les produits</a>
    <button id="validProductToAdd">Valider les produits</button>
</div>
<script src="/js/admin/ajax/productToAdd.js"></script>