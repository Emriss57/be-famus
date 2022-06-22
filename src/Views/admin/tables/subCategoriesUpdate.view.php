<h1 class="title">Modification de la categories : <?= ucfirst($context['app']['updateSubCategory']->getName()) ?></h1>

<form class="form" action="done" method="POST">
    <label for="nameInput">Nom de la catégorie</label>
   <input id="nameInput" type="text" name="categoryName" disabled value="<?= ucfirst($context['app']['updateSubCategory']->getParent()->getName()) ?>">
   <label for="nameInput">Modifier le nom de la sous-catégorie</label>
   <input id="nameInput" type="text" name="name" value="<?= ucfirst($context['app']['updateSubCategory']->getName()) ?>">
   <button>Valider</button>
</form>
