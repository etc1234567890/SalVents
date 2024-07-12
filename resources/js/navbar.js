// Hamburger DropDown
const menuButton = document.getElementById('menu-button');
const menu = document.getElementById('menu');

document.addEventListener("DOMContentLoaded", () => {
        if(menuButton && menu){        
                menuButton.addEventListener('click', () => {
                menu.classList.toggle('hidden');
        });
        }
        else{
                console.log('Start logging in');
        }

})