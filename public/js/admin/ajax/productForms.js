const categories = document.getElementById('categories');
const subCategories = document.getElementById('subCategories');

const attributeBtn = document.querySelectorAll('.attributeBtn');

const valuesContainer = document.getElementById('valuesContainer');

const productChecker = document.getElementById('productChecker');

const validProduct = document.getElementById('validProduct');
const removeProduct = document.getElementById('removeProduct');

categories.addEventListener('change', () => {
    getSubCategory();
});
function getSubCategory() {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState === 4 && xhr.status === 200) {
            subCategories.innerHTML = xhr.response
            console.log(xhr.response)
        } if(xhr.readyState === 4 && xhr.status === 404) {
            window.alert('erreur')
        }
    }
    xhr.open('POST', '/ajax/manageTraitement.php', true);
    xhr.responseType = "text";
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("category="  + categories.value);
}


validProduct.style.display = 'none';
removeProduct.style.display = 'none';
   validProduct.addEventListener('click', (e) => {
        e.preventDefault();
        const formData = new FormData(formProduct);
        formData.set('validProduct', 'true')
        const inputQuantity = document.querySelectorAll('.inputQuantity');
        const inputPriceImpact = document.querySelectorAll('.inputPriceImpact');
        const inputPhoto = document.querySelectorAll('.inputPhoto');
        let quantity = [];
        let priceImpact = [];
        let it = 0; 
        inputPriceImpact.forEach(element => {
            priceImpact.push(element.value);
        });
        inputQuantity.forEach(element => {
            quantity.push(element.value);
        });
        inputPhoto.forEach(file => {
           
            for(let i = 0; i < file.files.length; i++) {

               formData.append(`photo${it}[]`,file.files[i]);  
            }
            it++
      
        });

        formData.append('priceImpact', priceImpact)

        formData.append('quantity', quantity)
        sendForm(formData)
        
        validProduct.style.display = 'none';
        removeProduct.style.display = 'none';
        formData.delete('validProduct')
}) 

const formProduct = document.getElementById('formProduct');
formProduct.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(formProduct);
    formData.set('generateProduct', 'true')
    removeProduct.style.display = 'inline-block';
    validProduct.style.display = 'inline-block';
    sendForm(formData)
})

function sendForm(values) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState === 4 && xhr.status === 200) {

            productChecker.innerHTML = '';
            productChecker.insertAdjacentHTML('afterbegin' ,xhr.response);
            productChecker.appendChild(removeProduct);
            productChecker.appendChild(validProduct);

        } else if(xhr.readyState === 4 && xhr.status === 404) {
            productChecker.innerText = `Erreur : ${xhr.status}`;
        }
    }
    xhr.open('POST', '/ajax/manageTraitement.php', true);


    xhr.responseType = "text";
    xhr.send(values);
}

attributeBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        console.log(btn.nextElementSibling)
        btn.children[0].classList.toggle('bi-plus-circle')
        btn.children[0].classList.toggle('bi-dash-circle')
        btn.nextElementSibling.classList.toggle('valuesContainer2')
        btn.nextElementSibling.style.transitionDuration = '1s'

    });
})