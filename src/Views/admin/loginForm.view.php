
<style>
    body {
        background-color:#f5f6fa;
    }
</style>

<section>
   
    
    
    <form class="formLogin" action="connect" method="POST">
        <fieldset>
            <legend><i class="bi bi-person-fill"></i></legend>
            <?php if(isset($this->ctx['logError']) && $this->ctx['logError'] != '') {  ?>
            <div class="logError">
                <p><?= $this->ctx['logError']; ?></p>
            </div> 
            <?php } ?>
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="passw" placeholder="***********" required>
            <button type="submit">Se connecter</button>
        </fieldset>
    </form>




</section>    

