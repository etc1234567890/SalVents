document.addEventListener("DOMContentLoaded", function() {
    const image = document.getElementById('profile-picture');

    if(image){
        image.addEventListener('change',function previewProfilePicture() {
            const input = event.target;
            const preview = document.getElementById('profile-picture-preview');
            

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        })
    }
    else{
        console.log("")
    }
});
