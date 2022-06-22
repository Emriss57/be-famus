const attributeBtn = document.querySelectorAll('.attributeBtn')
const formProductToAdd = document.getElementById('formProductToAdd');
const submitForm = document.getElementById('submitForm');
const productChecker = document.getElementById('productChecker');
const validProduct = document.getElementById('validProductToAdd');
const removeProduct = document.getElementById('removeProduct');

validProduct.style.display = 'none';
removeProduct.style.display = 'none';

attributeBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        btn.children[0].classList.toggle('bi-plus-circle')
        btn.children[0].classList.toggle('bi-dash-circle')
        btn.nextElementSibling.classList.toggle('valuesContainer2')
        btn.nextElementSibling.style.transitionDuration = '1s'

    });
})

validProduct.addEventListener('click', (e) => {
    e.preventDefault();
    const formData = new FormData(formProductToAdd);
    formData.set('validProductToAdd', 'true')
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
})

formProductToAdd.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formProductToAdd);
    removeProduct.style.display = 'inline-block';
    validProduct.style.display = 'inline-block';
    formData.set('generateProductToAdd', 'true');
    sendForm(formData);

});

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