<header>
       
        <div class="linkContainer ">
            <div class="menuContainer" id="menuContainer">
                <div>
                    <button id="closeMenu" class="d-none closeMenu"><i class="bi-x-lg"></i></button>
                    <?php
                        foreach($this->globals['app']['categories'] as $category) { 
                            if(isset($match['params']['categories']) && $match['params']['categories'] === $category->getName()) {?>
                            <a class="linkStyleDisabled bgWhite" href="/categorie/<?= (int)$category->getId().'-'.$category->getName() ?>"><?= ucfirst($category->getName()) ?></a>
                    <?php 
                            } else {
                    ?>
                            <a class="linkStyleDisabled" href="/categorie/<?= (int)$category->getId().'-'.$category->getName() ?>"><?= ucfirst($category->getName()) ?></a>
                    <?php 
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="userIconMenu">
            <button id="mobileMenu" class="d-none mobileMenu"><i class="bi bi-list"></i></button>
            <div>

                <span class="iconMenu p-3 ">
                    <?php if($this->auth->getUserField('code') !== 200) { ?>
                    <i class="bi bi-person-circle"></i>
                    <?php } else { ?>
                    <img class="avatar" src="<?= $this->auth->getUserField('img') ?>" alt="">
                    <?php } ?>
                    <ul class="d-none userMenu">
                        <?php if($this->auth->getUserField('code') !== 200) { ?>
                            <li>
                                <a href="/user/">Se connecter / S'enregistrer</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <p><?= $this->auth->getUserField('lastname').' '.$this->auth->getUserField('firstname'); ?></p>
                            </li>
                            <li>
                                <a href="/user/profile">Voir son profile</a>
                            </li>
                            
                            <li>
                                <form action="/user/disconnect" method="POST">
                                    <button class="disconnectBtn" type="submit">Déconnexion</button>
                                </form>
                            </li>
                        <?php } ?>
                     </ul>
            </span>
            <span class="iconMenu p-3">
                
                <i class="bi bi-basket2"></i>
                <?php if($this->auth->getUserField('code') === 200) { ?>
                    <div class="counter">0</div>
                <?php } ?>
                <ul class="d-none userMenu">
                    <?php if($this->auth->getUserField('code') !== 200) { ?>
                            <li>
                                <a href="/user/">Connectez-vous</a>
                            </li>
                    <?php } else { ?>
                            <li>
                                <a href="/user/basket">Voir le panier</a>
                            </li>
                            <?php } ?>
                        </ul>
            </span>
            </a>
            <a class="linkStyleDisabled p-3" href="">
                <i class="bi bi-heart"></i>
                0
            </a>
            <a class="linkStyleDisabled p-3 " href="">
                <i class="bi bi-globe2"></i>
            </a>
            </div>
        </div>
        <div class="logoContainer">
            <a href="/"><img class="logo" src="/images/229f4daeff154a438d5841d26e09a95d.png" alt=""></a>
        </div>
    </header>