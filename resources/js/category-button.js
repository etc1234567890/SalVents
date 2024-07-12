document.addEventListener("DOMContentLoaded", () => {
    const categoryButton = document.getElementById('categoryButton');
    const categoryDropdown = document.getElementById('categoryDropdown');

    if (categoryButton && categoryDropdown) {
        categoryButton.addEventListener('click', () => {
            categoryDropdown.classList.toggle('hidden');
        });
    } else {
        console.warn('Category button or dropdown not found on this page.');
    }
});