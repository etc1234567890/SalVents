// JavaScript for navbar color change on scroll
document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById('navbar');
    if(navbar){
        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                navbar.classList.add('navbar-scrolled');
                menu.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
                menu.classList.remove('navbar-scrolled');
            }
        })
    }else{
        console.log(" ");
    }
})