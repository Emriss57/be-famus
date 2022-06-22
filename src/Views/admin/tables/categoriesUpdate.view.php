<h1 class="title">Modification de la categories : <?= ucfirst($context['app']['updateCategory']->getName()) ?></h1>

<form class="form" action="done" method="POST">
   <label for="nameInput">Modifier le nom de la catégorie</label>
   <input id="nameInput" type="text" name="name" value="<?= ucfirst($context['app']['updateCategory']->getName()) ?>">
   <button>Valider</button>
</form>

