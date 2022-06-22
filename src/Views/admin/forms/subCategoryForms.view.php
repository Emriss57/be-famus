<h1 class="title">Créer une sous-catégorie</h1>

<form class="form" action="insert" method="POST">
<label for="categorySelect">Choisir la catégorie</label>
    <select name="categories" id="categorySelect">
        <option value="" selected disabled>Choissisez votre catégories</option>
        <?php foreach($context['app']['categories'] as $category) { ?>
            <option value="<?= $category->getId()?>"><?= $category->getName()?></option>
        <?php } ?>
    </select>
    <label for="nameInput">Ajouter un nom à la sous-catégorie</label>
    <input placeholder='Nom de la sous-categorie' id="nameInput" type="text" name="name">
    <button>Valider</button>
</form>
