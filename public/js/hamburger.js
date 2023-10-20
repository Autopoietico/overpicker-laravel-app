let headerNav, burgerButton;

function hamburgerValidation() {
    headerNav = document.getElementById("header-nav");
    burgerButton = document.getElementById("burger-menu");

    burgerButton.addEventListener("click", hideShow);
}

function hideShow() {
    if (headerNav.classList.contains("invisible")) {
        headerNav.classList.remove("invisible");
        headerNav.classList.remove("opacity-0");
        headerNav.classList.add("opacity-100");
        burgerButton.classList.remove("bg-[#294452]");
        burgerButton.classList.add("bg-[#1C2E37]");
    } else {
        headerNav.classList.remove("opacity-100");
        headerNav.classList.add("opacity-0");
        burgerButton.classList.remove("bg-[#1C2E37]");
        burgerButton.classList.add("bg-[#294452]");
        setTimeout(() => {
            headerNav.classList.add("invisible");
        }, 300);
    }
}

hamburgerValidation();
