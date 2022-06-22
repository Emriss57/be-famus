const selectAttribute = document.getElementById('selectAttribute');
const contentInput = document.getElementById('contentInput');

selectAttribute.addEventListener('change', () => {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
    if(xhr.readyState === 4 && xhr.status === 200) {
        contentInput.setAttribute('type',xhr.response);
        console.log(xhr.response)
        
    }else if(xhr.readyState === 4 && xhr.status === 404) {
        productChecker.innerHTML = `Erreur : ${xhr.status}`;
    }
}
xhr.open('POST', '/ajax/manageTraitement.php', true);
xhr.responseType = "text";
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send('attributes=' + selectAttribute.value);


});