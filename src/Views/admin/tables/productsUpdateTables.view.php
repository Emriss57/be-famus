<h1 class="title">Modifier le produit</h1>
<div class="tableContainer">
<table class="table">
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
    </tr>
    <tr class="firstColor">
        <td><?= $context['app']['productToUpdate']->getId() ?></td>
        <td><?= $context['app']['productToUpdate']->getCategory()->getParent()->getName() ?></td>
        <td><?= $context['app']['productToUpdate']->getCategory()->getName() ?></td>
        <td><?= $context['app']['productToUpdate']->getName() ?></td>
        <td><?= $context['app']['productToUpdate']->getDescription() ?></td>
        <td><?= $context['app']['productToUpdate']->getCreateDate() ?></td>
        <td>
            <a  href="/admin-controls/tables/products/add/<?= $context['app']['productToUpdate']->getId() ?>/">
                <i class="bi bi-plus-square-fill"></i>
            </a>
        </td>
        <td>
            <a href="/admin-controls/tables/products/update/<?= $context['app']['productToUpdate']->getId() ?>/">
                <i class="bi bi-gear-fill"></i>
            </a>
        </td>
        <td>
            <a  href="/admin-controls/tables/products/delete/<?= $context['app']['productToUpdate']->getId() ?>/" onclick="return confirm('Voulez-vous vraiment supprimer le produit : <?= $context['app']['productToUpdate']->getName() ?> se trouvant dans la catégorie : <?= $context['app']['productToUpdate']->getCategory()->getParent()->getName() ?> / <?=$context['app']['productToUpdate']->getCategory()->getName() ?> ? Attention cela effacera toutes les déclinaisons de produit associées. ')">
                <i class="bi bi-x-octagon-fill"></i>
            </a>
        </td>
    </tr>

</table>

</div>
<form class="form" id="formProduct" action="done" method="POST">
    <div class="separatorContainer">
        <label for="categories">Catégorie du produit</label>
        <select name="categories" id="categories" required disabled>
            <option value="<?= $context['app']['productToUpdate']->getCategory()->getParent()->getId() ?>" selected><?= $context['app']['productToUpdate']->getCategory()->getParent()->getName() ?></option>
           
        </select>
        <label for="">Modifier la sous-catégorie du produit</label>
        <select name="subCategories" id="subCategories" required>
        <?php foreach($context['app']['subCategories']($context['app']['productToUpdate']->getCategory()->getParent()->getId()) as $subCategory){ ?>
                        <option value="<?= $subCategory->getId() ?>"><?= ucfirst($subCategory->getName()) ?></option>
            <?php }?>
            
        </select>

        <label for="name">Modifier le nom du produit</label>
        <input id='name' type="text" name="productName" value="<?= $context['app']['productToUpdate']->getName() ?>" required>
        <label for="description">Modifier la description du produit</label>
        <textarea rows="5" id='description' name="description"  required><?= $context['app']['productToUpdate']->getDescription() ?></textarea>
        
        
        <label for="createdDate">Date de modification</label>
        <input id="createdDate" name="createdDate" type="date" min="<?= $context['date']?>" max="<?= $context['date']?>" value="<?= $context['date']?>">
    </div>
    
    <button name="generateProduct" type="submit" id="submitForm">Modifier le produit</button>  
</form>