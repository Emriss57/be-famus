<h1 class="title"><?= $context['content'] ==='values' ? 'Entrez une valeur' : 'Créer un attribut'?></h1>

<form class="form" action="insert" method="POST">
	
	<div class="ongletDisplay">
		<a class="link <?= $context['content'] ==='values' ? 'disabled' : 'active'?>" href="/admin-controls/forms/attributes/">Attributs</a>
		<a class="link <?= $context['content'] ==='values' ? 'active' : 'disabled'?>" href="/admin-controls/forms/values/">Valeurs</a>
	</div>
	<?php if($context['content'] !== 'values'){   ?>
	 	<label for="nameInput">Ajouter un nom à l'attribut</label>
        <input required placeholder="Nom de l'attribut" id="nameInput" type="text" name="name">
		<label for="typeInput">Ajouter un type à la valeur</label>
		<input placeholder="Type de valeur" required id="typeInput" type="text" name="type">
        <button>Valider</button>
	<?php } else { ?>
		<select name="attribute" required id="selectAttribute">
			<option value="" selected disabled>Choisir un attribut pour affecter une valeur</option>
			<?php foreach($context['attributes'] as $attribute){ ?>
				<option value="<?= $attribute->getId() ?>"><?= $attribute->getName() ?></option>
			<?php }?>
		</select>
		<label for="nameInput">Ajouter une valeur</label>
        <input required placeholder="Entrez la valeur" id="contentInput" name="content">  
       	<button>Valider</button>
	<?php } ?>
</form>
<script src="/js/admin/ajax/attributeForms.js"></script>