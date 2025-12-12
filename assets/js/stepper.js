/* ==========================================================
   STEP NAVIGATION
========================================================== */

document.addEventListener("DOMContentLoaded", () => {
    const stepItems = document.querySelectorAll(".step-list li");

    stepItems.forEach(li => {
        li.addEventListener("click", () => {
            const step = li.dataset.step;
            window.location.href = "index.php?step=" + step;
        });
    });
});
