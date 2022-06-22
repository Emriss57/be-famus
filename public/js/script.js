window.addEventListener('load', () => {
    const bodyClass = document.getElementById('bodyDark');
    const themeSlider = document.getElementById('themeSlider');
    getCookie('theme') != null ? bodyClass.classList.add(getCookie('theme')) : bodyClass.classList.add('regularTheme');
    getCookie('theme') == 'darkTheme' ? themeSlider.checked = true : themeSlider.checked = false;
    themeSlider.addEventListener('click', () => {
        sendTheme();
    });

    function sendTheme() {
        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if(xhr.readyState === 4 && xhr.status === 200) {
                bodyClass.classList.remove(bodyClass.classList)
                bodyClass.classList.add(getCookie('theme'))
            } else if(xhr.readyState === 4 && xhr.status === 404) {
                window.alert('erreur')
            }
        }
        xhr.open('POST', '/ajax/traitement.php', true);
        xhr.responseType = "text";
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("themeChoose="  + themeSlider.checked);
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
    
    

    
});
const userMenu = document.getElementById('userMenu');
const userMenuDisplay = document.getElementById('userMenuDisplay');
const mobileMenu = document.getElementById('mobileMenu');
const closeMenu = document.getElementById('closeMenu');
const menuContainer = document.getElementById('menuContainer');

mobileMenu.addEventListener('click', () => {
    menuContainer.style.left = '0';
    menuContainer.style.transitionDuration = '2s';

})

closeMenu.addEventListener('click', () => {
    menuContainer.style.left = '-53%';
})

const iSearch = document.querySelectorAll('.iSearch')
iSearch.forEach(element => {
    element.addEventListener('click', () => {
        
        element.classList.toggle('bi-plus-circle')
        element.classList.toggle('bi-dash-circle')
        element.nextElementSibling.classList.toggle('searchMotorSection');
       
        
        
    });
});


/////////////// menu User ////////////////////

const iconMenu = document.querySelectorAll('.iconMenu');

iconMenu.forEach(element => {
    element.addEventListener('click', () => {
        element.children[1].classList.toggle('d-none')
    });
});

// userMenuDisplay.addEventListener('click', () => {
//     userMenu.classList.toggle('d-none');
// });
// const searchForm = document.getElementById('searchForm');

// const searchInput = document.querySelectorAll('.check');

// searchInput.forEach(element => {
//     element.addEventListener('change', () => {
//         let formData = new FormData(searchForm);
//         searchProducts(formData)
//     })
// });
// function searchProducts(form) {

//     let xhr = new XMLHttpRequest();

//      xhr.onreadystatechange = () => {

//         if(xhr.readyState === 4 && xhr.status === 200) {
//             console.log(xhr.response)
//         } else if(xhr.readyState === 4 && xhr.status === 404) {

//         }


//     }
//     xhr.open('POST', '/categorie/traitement.php', true)
//     xhr.responseType = "text";
//     xhr.send(form);
// }


const firstDisplay = document.getElementById('firstDisplay');
const secondDisplay = document.querySelectorAll('.secondDisplay');
let elementArray = [];

secondDisplay.forEach(element => {
    element.addEventListener('click', () => {
        elementArray = [element];
        

        
        firstDisplay.src = element.src
        
        lastElement = elementArray.pop()
        lastElement.style.border = 'solid 1px black'
        firstElement = elementArray.shift()
        firstElement.style.border = 'none'
    })
})