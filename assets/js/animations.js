document.addEventListener("DOMContentLoaded", function () {
    const portfolioItems = document.querySelectorAll(".portfolio-item");

    portfolioItems.forEach(item => {
        item.style.opacity = "0";
        item.style.transform = "translateY(20px)";
        item.style.transition = "opacity 0.5s ease-out, transform 0.5s ease-out";
    });

    window.addEventListener("scroll", function () {
        portfolioItems.forEach(item => {
            if (item.getBoundingClientRect().top < window.innerHeight - 100) {
                item.style.opacity = "1";
                item.style.transform = "translateY(0)";
            }
        });
    });
});