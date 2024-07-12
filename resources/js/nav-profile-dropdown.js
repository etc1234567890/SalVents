document.addEventListener("DOMContentLoaded", () => {
    const prof = document.getElementById('profile-button')
    
    if(prof){
        prof.addEventListener('click', function() {
            var profileMenu = document.getElementById('profile-menu');
            profileMenu.classList.toggle('hidden');
        });
    } else{
        console.log("Profile does not exist")
    }
})