let headerNav, burgerButton;

function hamburgerValidation(){

    headerNav = document.getElementById('header-nav');
    burgerButton = document.getElementById('burger-menu');

    burgerButton.addEventListener('click', hideShow);
}

function hideShow(){
    if(headerNav.classList.contains('invisible')){
        headerNav.classList.remove('invisible');
        burgerButton.classList.remove('bg-[#294452]')
        burgerButton.classList.add('bg-[#1C2E37]')
    }else{
        headerNav.classList.add('invisible');
        burgerButton.classList.remove('bg-[#1C2E37]')
        burgerButton.classList.add('bg-[#294452]')
    }
}

hamburgerValidation();