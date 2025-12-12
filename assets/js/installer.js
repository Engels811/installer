/* ============================================================
   WONDERLIFE INSTALLER – CORE ENGINE (FINAL BUILD v4)
   Handles: language, sidebar steps, dropdown, bootscreen, DB test
============================================================ */

const WLInstaller = {

    /* --------------------------------------------------------
       LANGUAGE HANDLING
    -------------------------------------------------------- */
    toggleLanguageMenu() {
        const menu = document.getElementById("langMenu");
        if (menu) menu.classList.toggle("show");
    },

    setLanguage(lang) {
        const params = new URLSearchParams(window.location.search);

        const step = params.get("step") || "boot";

        // Smooth fade-out animation
        document.body.style.opacity = "0";

        setTimeout(() => {
            window.location = `?step=${step}&lang=${lang}`;
        }, 180);
    },


    /* --------------------------------------------------------
       SIDEBAR HIGHLIGHTER
    -------------------------------------------------------- */
    highlightCurrentStep() {
        const params = new URLSearchParams(window.location.search);
        const step = params.get("step") || "boot";

        document.querySelectorAll(".step-list li").forEach(li => {
            li.classList.remove("active");

            if (li.dataset.step === step) {
                li.classList.add("active");
            }
        });
    },


    /* --------------------------------------------------------
       BOOTSCREEN HANDLING
    -------------------------------------------------------- */
    initBootscreen() {
        const boot = document.getElementById("wl-boot");
        if (!boot) return;

        setTimeout(() => {
            boot.style.opacity = 0;
            setTimeout(() => boot.style.display = "none", 800);
        }, 5200);
    },


    /* --------------------------------------------------------
       DATABASE CONNECTION TEST (AJAX)
    -------------------------------------------------------- */
    async testDatabaseConnection() {

        const host = document.getElementById("db_host").value;
        const user = document.getElementById("db_user").value;
        const pass = document.getElementById("db_pass").value;
        const db   = document.getElementById("db_name").value;
        const port = document.getElementById("db_port").value;

        const resultBox = document.getElementById("db_test_result");
        const nextBtn   = document.getElementById("next_btn");

        resultBox.innerHTML = "Testing connection…";
        resultBox.style.color = "#d8baff";

        try {
            const response = await fetch("ajax/test_db.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    host,
                    user,
                    pass,
                    name: db,
                    port
                })
            });

            const json = await response.json();

            if (json.status === "ok") {
                resultBox.innerHTML = "Connection SUCCESS";
                resultBox.style.color = "#00ff88";

                // Unlock NEXT button
                if (nextBtn) {
                    nextBtn.style.opacity = "1";
                    nextBtn.style.pointerEvents = "auto";
                }

                // Save db session data
                await fetch("ajax/save_db_session.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ host, user, pass, db, port })
                });

            } else {
                resultBox.innerHTML = "FAILED: " + json.message;
                resultBox.style.color = "#ff006a";
            }

        } catch (err) {
            resultBox.innerHTML = "ERROR: " + err.message;
            resultBox.style.color = "#ff006a";
        }
    }
};


/* ============================================================
   GLOBAL INITIALIZER
============================================================ */
document.addEventListener("DOMContentLoaded", () => {

    // Sidebar highlight
    WLInstaller.highlightCurrentStep();

    // Bootscreen fade-out
    WLInstaller.initBootscreen();

    // Close language menu when clicking outside
    document.addEventListener("click", function(e) {
        const menu = document.getElementById("langMenu");
        const trigger = document.querySelector(".lang-current");

        if (!menu || !trigger) return;

        if (!trigger.contains(e.target)) {
            menu.classList.remove("show");
        }
    });
});
