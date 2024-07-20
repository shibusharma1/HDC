// carousel.js
document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    const carouselImages = document.querySelector('.carousel-images');
    const totalSlides = document.querySelectorAll('.carousel-item').length;

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        const newTransformValue = `translateX(-${currentIndex * 100}%)`;
        carouselImages.style.transform = newTransformValue;
    }

    setInterval(showNextSlide, 8000); // Change slide every 8 seconds
});
