document.addEventListener("DOMContentLoaded", () => {
    // Mobile Menu Toggle
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");
    if (menuToggle) {
        menuToggle.addEventListener("click", () => navLinks.classList.toggle("show"));
    }

    // Image Slider Logic
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slide");
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");

    function showSlide(n) {
        if (slides.length === 0) return;
        slides.forEach(s => s.classList.remove("active"));
        slideIndex = (n + slides.length) % slides.length;
        slides[slideIndex].classList.add("active");
    }

    if (slides.length > 0) {
        showSlide(0);
        if (prevBtn) prevBtn.addEventListener("click", () => showSlide(slideIndex - 1));
        if (nextBtn) nextBtn.addEventListener("click", () => showSlide(slideIndex + 1));
        setInterval(() => showSlide(slideIndex + 1), 5000);
    }
});
