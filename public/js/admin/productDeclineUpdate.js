const attributeBtn = document.querySelectorAll('.attributeBtn');



attributeBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        btn.children[0].classList.toggle('bi-plus-circle')
        btn.children[0].classList.toggle('bi-dash-circle')
        btn.nextElementSibling.classList.toggle('valuesContainer2')
        btn.nextElementSibling.style.transitionDuration = '1s'

    });
})