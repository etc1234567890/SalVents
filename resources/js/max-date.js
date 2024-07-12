document.addEventListener("DOMContentLoaded", function() {
 // Get the birthdate input element
   const birthdateInput = document.getElementById('birthdate');

   if(birthdateInput){
   // Set the maximum allowed date to today
        birthdateInput.max = new Date().toISOString().split('T')[0];

        // Function to handle date change
        birthdateInput.addEventListener('input', function () {
            const selectedDate = new Date(this.value);
            const today = new Date();

            // Disable future dates in the date picker
            if (selectedDate > today) {
                this.value = ''; // Clear the input value if future date is selected
            }
    });
    }else{
        console.log(' ');
    }
});
