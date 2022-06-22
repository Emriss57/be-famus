<h1 class="title">Modification de <?= $context['content'] ==='values' ? 'la valeurs' : 'l\'attributs' ?> : <?= isset($context['app']['updateAttribute']) ? ucfirst($context['app']['updateAttribute']->getName()) :  ucfirst($context['app']['updateValue']->getContent())?></h1>


<?php 
    if($context['content'] === 'attributes') {
?>
<form class="form" action="done" method="POST">
   <label for="nameInput">Modifier le nom de l'attribut</label>
   <input id="nameInput" type="text" name="name" value="<?= ucfirst($context['app']['updateAttribute']->getName()) ?>">
   <button>Valider</button>
</form>

<?php
    } else {
?>
<form class="form" action="done" method="POST">
    <label for="nameInput">Nom de l'attribut</label>   
    <input id="nameInput" type="text" name="name" value="<?= ucfirst($context['app']['updateValue']->getAttribute()->getName()) ?>" disabled>
    <label for="nameInput">Modifier la valeur</label>
    <input id="nameInput" type="text" name="name" value="<?= ucfirst($context['app']['updateValue']->getContent()) ?>">
    <button>Valider</button>
</form>
<?php
    }
?>
