

    const userMenu = document.getElementById('userMenu');
    const userMenuDisplay = document.getElementById('userMenuDisplay');

    const menuBtn = document.getElementById('menuBtn'); //
    const nav = document.getElementById('nav');
    const linksDisplay = document.querySelectorAll('.display');

    const manageBtn = document.querySelectorAll('.manageBtn');
    
    /////////////// localStorage check ////////////////////

    if(localStorage.getItem('mode') === 'active' && localStorage.getItem('mode2') !== 'active') {
        nav.classList.add('slidein');
        menuBtn.firstChild.classList.add('bi-x-lg')
        linksDisplay.forEach(link => { 
            link.classList.remove('displayLink')
            link.parentElement.style.textAlign = 'start';
        })
        manageBtn.forEach(btn => { 
            btn.classList.remove('displayLink')
            btn.parentElement.style.justifyContent = 'space-between';
        })
    } 

    /////////////// Header ////////////////////
    
    const searchContainer = document.getElementById('searchContainer');
    const searchBtn = document.getElementById('searchBtn');
    const searchInput = document.getElementById('searchInput');
    const removeSearch = document.getElementById('removeSearch');
    const searchOuput = document.getElementById('searchOuput');
    removeSearch.addEventListener('click', () => { 
        searchContainer.style.top = '-50%';
        searchInput.value = '';
    });
    searchBtn.addEventListener('click', () => {
        searchContainer.style.transitionDuration = '2s';
        searchContainer.style.top = '50%';
    });
 
    searchInput.addEventListener('keydown', (e) => {
        searchInput.addEventListener('focusout', () => {
            if(searchInput != document.activeElement) {
                searchOuput.style.display = 'none';
            }
        })
        let reg = new RegExp('^[a-zA-Z0-9]')
        if(reg.test(searchInput.value) && searchInput != '') {
            let xhr = new XMLHttpRequest();
            searchOuput.style.display = 'none';
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4 && xhr.status === 200) {
                    if(xhr.response !== '') {
                        searchOuput.innerHTML = '';
                        searchOuput.style.display = 'flex';
                        searchOuput.insertAdjacentHTML('afterbegin',xhr.response);

                    }

                } else {
    
                }
            }
    
            xhr.open('POST', '/ajax/manageTraitement.php', true);
            xhr.responseType = "text";
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('search=' + searchInput.value);
        }

    });
    /////////////// menu header ////////////////////
    
    const menuBtn2 = document.getElementById('menuBtn2');
    let activeMenu2 = false;
    menuBtn2.addEventListener('click', () => {
        toggleMenu();
        nav.style.left = '0%'
        localStorage.setItem('mode2', 'active');
        activeMenu2 = true;
    })

    /////////////// menu nav ////////////////////
    menuBtn.addEventListener('click', () => {
        toggleMenu();
        if(activeMenu2 === true) {
            nav.style.left = '-50%';
            
        } else {
            localStorage.setItem('mode2', 'disabled');
        }
    })
   
        function toggleMenu() {
            
            nav.classList.toggle('slidein')
            manageBtn.forEach(btn => { 
                btn.classList.toggle('displayLink');
            })
            menuBtn.firstChild.classList.add('bi-x-lg')
            nav.style.transitionDuration = '2s';
            if(nav.classList.contains('slidein')) {
                localStorage.setItem('mode', 'active');
                linksDisplay.forEach(link => {
                    link.parentElement.style.justifyContent = 'space-between';
                    link.parentElement.style.textAlign = 'start';
                    setTimeout(() => {
                        link.classList.remove('displayLink');
                    },1200)
                }); 
            } else {
                linksDisplay.forEach(link => {
                    link.classList.add('displayLink')
                    link.parentElement.style.justifyContent = 'center';
                    link.parentElement.style.textAlign = 'center';
                }); 
                manageBtn.forEach(btn => { 
                    btn.nextElementSibling.classList.add('displayLink')
                    btn.classList.remove('rotate')
                    btn.children[0].classList.add('bi-caret-right')
                    btn.children[0].classList.remove('bi-caret-right-fill')
                })
                menuBtn.firstChild.classList.remove('bi-x-lg')
                localStorage.setItem('mode', 'disabled');
            }  
        }
         /////////////// menu dans l'nav  ////////////////////
        manageBtn.forEach(btn => { 
            btn.addEventListener('click', () => {
            
                btn.nextElementSibling.classList.toggle('displayLink')

                btn.children[0].classList.toggle('bi-caret-right')
                btn.children[0].classList.toggle('bi-caret-right-fill')
                btn.classList.toggle('rotate')
                btn.style.transitionDuration =  '1s';
            });
        })
   /////////////// menu User ////////////////////

        userMenuDisplay.addEventListener('click', () => {
            userMenu.classList.toggle('displayLink');
        });


/////////////// Product table ////////////////////

const declineBtn = document.querySelectorAll('.declineBtn');


declineBtn.forEach(element => {

    element.addEventListener('click', () => {
        console.log(element.parentNode)
        element.parentElement.parentElement.parentElement.nextElementSibling.style.display = 'table-row-group'
    });

});