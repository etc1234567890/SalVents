document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('[id^="dropdownMenuButton-"]').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.id.split('-')[1];
            document.getElementById(`dropdownMenu-${postId}`).classList.toggle('hidden');
        });
    });

    // Optional: Close the dropdown when clicking outside of it
    window.addEventListener('click', function(e) {
        document.querySelectorAll('[id^="dropdownMenuButton-"]').forEach(button => {
            const postId = button.id.split('-')[1];
            if (!button.contains(e.target) && !document.getElementById(`dropdownMenu-${postId}`).contains(e.target)) {
                document.getElementById(`dropdownMenu-${postId}`).classList.add('hidden');
            }
        });
    });
    });