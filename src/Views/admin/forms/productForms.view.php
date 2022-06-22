<h1 class="title">Créer un produit</h1>



<form class="form" id="formProduct">
    <div class="separatorContainer">
        <label for="categories">Choissisez la catégorie du produit</label>
        <select name="categories" id="categories" required>
            <option value="" selected disabled>Veuillez choisir une catégorie</option>
            <?php foreach($context['app']['categories'] as $categorie){ ?>
                        <option value="<?= $categorie->getId() ?>"><?= ucfirst($categorie->getName()) ?></option>
            <?php }?>
        </select>
        <label for="">Choissisez la sous-catégorie du produit</label>
        <select name="subCategories" id="subCategories" required>
            <option value="" selected disabled>Veuillez choisir une sous-catégorie</option>
        </select>

        <label for="name">Entrez le nom du produit</label>
        <input id='name' type="text" name="productName" placeholder="Saisissez le nom du produit" required>
        <label for="description">Entrez la description du produit</label>
        <textarea rows="5" id='description' name="description" required>Saisissez la description du produit</textarea>
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
    <button name="generateProduct" type="submit" id="submitForm">Générer les produits</button>  
</form>
<div id="productChecker">
    <a href="/admin-controls/forms/products/" id="removeProduct">Annuler les produits</a>
    <button id="validProduct">Valider les produits</button>
</div>
<script src="/js/admin/ajax/productForms.js"></script>