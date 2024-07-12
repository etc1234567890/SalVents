document.addEventListener("DOMContentLoaded", function() {
    const profilePictures = document.querySelectorAll('.profile-picture');
    const floatingWindow = document.getElementById('floatwindow');
    const authorNameElement = document.getElementById('authorName');
    const authorDescriptionElement = document.getElementById('authorDescription');
    const wallpaperElement = floatingWindow.querySelector('.author-wallpaper');

    if (floatingWindow && profilePictures.length > 0) {
        function showFloatingWindow(event) {
            const rect = event.target.getBoundingClientRect();
            const topPosition = rect.top + window.scrollY - (floatingWindow.offsetHeight / 2) + (rect.height / 2);
            const leftPosition = rect.right + 12;
            
            floatingWindow.style.top = `${Math.max(0, topPosition)}px`;
            floatingWindow.style.left = `${leftPosition}px`;

            const profilePicture = event.currentTarget;
            const name = profilePicture.getAttribute('data-name');
            const bio = profilePicture.getAttribute('data-bio');
            const wallpaper = profilePicture.getAttribute('data-wallpaper');

            authorNameElement.textContent = name;
            authorDescriptionElement.textContent = bio;
            wallpaperElement.style.backgroundImage = `url(${wallpaper})`;

            floatingWindow.classList.remove('hidden');
        }

        function hideFloatingWindow() {
            floatingWindow.classList.add('hidden');
        }

        profilePictures.forEach(profilePicture => {
            profilePicture.addEventListener('mouseenter', showFloatingWindow);
            profilePicture.addEventListener('mouseleave', hideFloatingWindow);
        });

        floatingWindow.addEventListener('mouseenter', () => {
            floatingWindow.classList.remove('hidden');
        });
        floatingWindow.addEventListener('mouseleave', hideFloatingWindow);
    } else {
        console.log("Floating window or profile pictures not found.");
    }
});
