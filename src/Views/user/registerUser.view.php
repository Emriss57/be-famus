<section>
        
    <form class="formLogin2" action="/user/register/request" method="POST">
        <fieldset>
            <legend><h1>Créer un compte</h1></legend>
            <div class="separator">

                <label for="">Entrez votre nom</label>
                <input  minlength="5" maxlength="25" type="text" name="lastname" required placeholder="Nom">     
                <label for="">Entrez votre prénom</label>
                <input  minlength="5" maxlength="25" name="firstname" type="text" required placeholder="Prénom">
                <label for="">Date de naissance</label>
                <input  name="birthDate" type="date" required placeholder="Prénom">
                <label for="">Entrez votre email</label>
                <input class="check"  id="emailInput" name="email" type="email" placeholder="example@test.com" required>
            </div>
            <hr>
            <div class="separator">
                <label for="">Entrez un nom d'utilisateur</label>
                <input class="check" name="username" type="text" placeholder="Nom d'utilisateur" required>
                <label for="">Entrez un mot de passe</label>
                <input id="passw" class="check" name="passw" title="OBLIGATOIRE : Doit commencer par une majuscule et contenir des chiffres"  type="password" placeholder="8 caractères mini." required>
                <label for="">Confirmer votre mot de passe</label>
                <input id='confirmPassw'  name="confirmPassw" type="password" placeholder="mot de passe" required> 
            </div>
            <button type="submit">Se connecter</button>
            <p>Vous avez un compte ? <a href="/user/">Connectez-vous</a></p>
            </fieldset>            
    </form>
</section>
<style>
header {
  box-shadow: 0px 1px 10px 0px grey;
}
</style>


<script src="/js/formChecker.js"></script>