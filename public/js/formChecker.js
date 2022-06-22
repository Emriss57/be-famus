



const confirmPass = document.getElementById('confirmPassw');

const displayError = document.createElement('P');

displayError.classList.add('errorRegisterUser');

const checkInput = document.querySelectorAll('.check');

let checkPass = '';
checkInput.forEach(element => {
    element.addEventListener('keyup', () => {
        sendField(`${element.name}=`, element, element.value);
        if(element.name === 'passw') {
            checkPass = element.value;
        }
    })

    element.addEventListener('focusout', () => {
        element.previousElementSibling.contains(displayError) ? element.previousElementSibling.removeChild(displayError) : '';
        element.style.backgroundColor = 'white';
        element.style.color = 'black';
    })
})

confirmPass.addEventListener('keyup',() => {
    if(checkPass === confirmPass.value && checkPass !== '') {
        confirmPass.style.backgroundColor = 'green';            
        displayError.style.backgroundColor = 'green';
        displayError.style.borderColor = 'green';
        displayError.style.color = 'white';
        displayError.innerText = `mot de passe concordant`;
    } else {
        confirmPass.style.backgroundColor = 'red';
        confirmPass.style.color = 'white';
        displayError.style.color = 'white';
        displayError.style.backgroundColor = 'red';
        displayError.style.borderColor = 'red';
        displayError.innerText = 'mot de passe différent';
    }

    confirmPass.previousElementSibling.appendChild(displayError);
});

confirmPass.addEventListener('focusout', () => {
    confirmPass.previousElementSibling.contains(displayError) ? confirmPass.previousElementSibling.removeChild(displayError) : '';
    confirmPass.style.backgroundColor = 'white';
    confirmPass.style.color = 'black';
})
  




function sendField(fieldName,element,fieldValue){

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {    
                if(xhr.readyState === 4 && xhr.status === 200) {

                    if(xhr.response === '1') {
                        element.style.backgroundColor = 'green';            
                        displayError.style.backgroundColor = 'green';
                        displayError.style.borderColor = 'green';
                        displayError.style.color = 'white';
                        displayError.innerText = `${element.name} valide`;
                        
                    } else {
                        element.style.backgroundColor = 'red';
                        element.style.color = 'white';
                        
                        displayError.style.backgroundColor = 'red';
                        displayError.style.borderColor = 'red';
                        element.previousElementSibling.appendChild(displayError);
                        displayError.innerText = xhr.response;
                    }
                } else if(xhr.readyState === 4 && xhr.status === 404) {

                }
            
        }    
        
        xhr.open('POST', '/ajax/traitement.php', true)
        xhr.responseType = 'text';
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.send(fieldName + fieldValue);

}