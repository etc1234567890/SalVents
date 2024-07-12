document.addEventListener("DOMContentLoaded", () => {
    const birthday = document.getElementById('birthdate');

    if (birthday) {
        function calculateAge(birthdate) {
            var today = new Date();
            var birthDate = new Date(birthdate);

            // Check if the birthdate is valid and within a reasonable range
            if (isNaN(birthDate.getTime())) {
                console.warn('Invalid birthdate format or value:', birthdate);
                return NaN; // Return NaN if birthdate cannot be parsed
            }

            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }

        // Update age field when birthdate changes
        birthday.addEventListener('change', function() {
            var age = calculateAge(this.value);
            if (!isNaN(age)) {
                document.getElementById('age').value = age;
            } else {
                document.getElementById('age').value = ''; // Clear age field if NaN
            }
        });

        // Update age field on page load
        window.addEventListener('load', function() {
            var birthdateValue = birthday.value;
            var age = calculateAge(birthdateValue);
            if (!isNaN(age)) {
                document.getElementById('age').value = age;
            } else {
                document.getElementById('age').value = ''; // Clear age field if NaN
            }
        });
    } else {
        console.warn('Birthdate field not found');
    }
});
