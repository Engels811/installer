/* ==========================================================
   BOOTSCREEN ANIMATION HELPERS
========================================================== */

document.addEventListener("DOMContentLoaded", () => {

    const scan = document.querySelector(".boot-scan");
    const particles = document.querySelector(".boot-particles");

    if (scan) {
        scan.style.animation = "scanMove 10s linear infinite";
    }

    if (particles) {
        particles.style.opacity = "5.5";
    }

});
