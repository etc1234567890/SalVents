    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('reason');
        const othersTextarea = document.getElementById('others');

        categorySelect.addEventListener('change', function () {
            if (categorySelect.value === 'Others') {
                othersTextarea.disabled = false;
                othersTextarea.placeholder = "Please describe the issue in detail";
                othersTextarea.classList.add('border-red-500');
            othersTextarea.classList.remove('border-gray-300');
            } else {
                othersTextarea.disabled = true;
                othersTextarea.placeholder = "";
                othersTextarea.classList.remove('border-red-500');
            othersTextarea.classList.add('border-gray-300');
            }
        });
    });