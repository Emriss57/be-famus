<section>

<style>
header {
  box-shadow: 0px 1px 10px 0px grey;
}
</style>

<div class="formContainer">
<?php if(isset($this->ctx['logError']) && $this->ctx['logError'] != '') {  ?>
    <div class="logError">
        <p><?= $this->ctx['logError']; ?></p>
    </div> 
<?php } ?>

<form class="formLogin2" action="/user/connect" method="POST">
   
    <fieldset>
        <legend>
        <h1>Connexion</h1>

        </legend>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Adresse email" required>
        <label for="pass">Mot de passe</label>
            <input id="pass" type="password" name="passw" placeholder="***********" required>
        <button type="submit">Se connecter</button>
        <p>Vous n'avez pas de compte ? <a href="/user/register">Créer un compte</a></p>
 
</form>
</div>
    
    
    


</section>