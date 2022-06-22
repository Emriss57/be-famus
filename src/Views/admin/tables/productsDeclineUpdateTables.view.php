<h1 class="title">Modifier la déclinaison</h1>
<div class="tableContainer">
<table class="table">
    <tr class="tableHeader">
        <td>ID</td>
        <td>Référence du produit</td>
        <td>Prix du produit</td>
        <?php foreach($context['attributes']  as $attribute) {?>
            <td><?= $attribute->getName() ?></td>
        <?php } ?>
        <td>modifier</td>
        <td>Supprimer</td>
    </tr>
    <tr class="firstColor">
        <td><?= $context['app']['productToUpdate']->getId() ?></td>
        <td><?= $context['app']['productToUpdate']->getReference() ?></td>
        <td><?= $context['app']['productToUpdate']->getPrice() ?></td>
        <?php foreach($context['app']['productToUpdate']->getCaracteristics() as $attribute) { ?>
            <td><?= preg_match('/^#[0-9a-fA-F]{6}/', $attribute->getContent()) ? '<span class="tableColor" style="background-color:'.$attribute->getContent().'"></span>' : $attribute->getContent()?></td>
        <?php } ?>
        <td>
            <a href="/admin-controls/tables/products/update/<?= $context['app']['productToUpdate']->getId() ?>/">
                <i class="bi bi-gear-fill"></i>
            </a>
        </td>
        <td>
            <a  href="/admin-controls/tables/products/delete/<?= $context['app']['productToUpdate']->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer le produit : <?= $context['app']['productToUpdate']->getReference() ?> ? ')">
                <i class="bi bi-x-octagon-fill"></i>
            </a>
        </td>
    </tr>

</table>

</div>
<form class="form" id="formProduct" action="done" method="POST">
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
                            <input required class="attributeInput" type="radio" name="<?= strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e') ?>" id='<?= $attributeValue->getContent() ?>' value="<?= $attributeValue->getId() ?>">
                        </div>
                <?php  } ?>
            </div> 
        <?php } ?>
        <label class="attributeLabel" for="price">Prix du produit</label>
                <input checked="checked" class="attributeInput" step="0.01" type="number" name="price" id='price' value="<?= $context['app']['productToUpdate']->getPrice() ?>" required>
    </div>
    
    <button name="generateProduct" type="submit" id="submitForm">Modifier le produit</button>  
</form>

<script src="/js/admin/productDeclineUpdate.js"></script>