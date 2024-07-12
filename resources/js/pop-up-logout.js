document.addEventListener("DOMContentLoaded", () => {
    const logoutButtons = document.querySelectorAll('#logout-button, #logout-button-mobile');
    const logoutModal = document.getElementById('logout-modal');
    const cancelButton = document.getElementById('cancel-button');

    logoutButtons.forEach(button => {
        button.addEventListener('click', function () {
            logoutModal.classList.remove('hidden');
        });
    });

    if (logoutModal && cancelButton) {
        // Hide logout modal
        cancelButton.addEventListener('click', function () {
            logoutModal.classList.add('hidden');
        });

        // Hide modal when clicking outside of it
        window.addEventListener('click', function (event) {
            if (event.target === logoutModal) {
                logoutModal.classList.add('hidden');
            }
        });
    }
});
