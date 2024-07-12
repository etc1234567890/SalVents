
document.addEventListener('DOMContentLoaded', function() {
    var tagInput = document.getElementById('tagInput');

    if(tagInput){
    
        tagInput.addEventListener('keydown', function(event) {
            // Allow only alphanumeric characters
            if (!/[a-zA-Z0-9]/.test(event.key)) {
                event.preventDefault();
            }
        });
    }
    else{
        console.log('');
    }
});
