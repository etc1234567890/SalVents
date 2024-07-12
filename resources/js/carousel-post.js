document.addEventListener("DOMContentLoaded", () => {

    const slides = document.querySelectorAll('.carousel-item');

    if (slides.length === 0) {
        console.warn("No carousel items found");
        return;
    }

    let slideIndex = 0;
    let slideWidth = slides[0].offsetWidth; // Get width of first slide
    let isMobile = window.innerWidth < 640; // Adjust as per your breakpoint

    function showSlides() {
        slideWidth = slides[0].offsetWidth; // Update slide width if viewport changes

        let slideOffset = -slideIndex * slideWidth;

        slides.forEach((slide) => {
            slide.style.transform = `translateX(${slideOffset}px)`;
        });
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlides();
    }

    function prevSlide() {
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlides();
    }

    // Show the first slide initially
    showSlides();

    // Re-show slides on window resize
    window.addEventListener('resize', function() {
        isMobile = window.innerWidth < 640; // Adjust as per your breakpoint
        showSlides();
    });

    document.getElementById('prevSlide').addEventListener('click', prevSlide);
    document.getElementById('nextSlide').addEventListener('click', nextSlide);

})