const basketForm = document.getElementById('basketForm');


basketForm.addEventListener('submit', (e) => {
e.preventDefault();
let formData = new FormData(basketForm);
sendForm(formData);

})



function sendForm(value) {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.response)
        } else if(xhr.readyState === 4 && xhr.status === 404) {

        }
    }


    xhr.open('POST','/ajax/traitement.php', true);
    xhr.responseType = 'text';
    xhr.send(value)
}