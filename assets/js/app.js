/* ============================================================
   WONDERLIFE MEGA SYSTEM – INSTALLER CORE JS  (FINAL BUILD v4.2)
   CyberCore Engine – NeonUX Framework
============================================================ */

const WLInstaller = {

    /* --------------------------------------------------------
       LANGUAGE SWITCHER + DROPDOWN ▼
    -------------------------------------------------------- */
    toggleLanguageMenu() {
        const menu = document.getElementById("langMenu");
        if (!menu) return;
        menu.classList.toggle("show");
    },

    setLanguage(lang) {
        const params = new URLSearchParams(window.location.search);
        const step = params.get("step") || "boot";

        document.body.style.opacity = "0";

        setTimeout(() => {
            window.location = `?step=${step}&lang=${lang}`;
        }, 180);
    },


    /* --------------------------------------------------------
       SIDEBAR ACTIVE HIGHLIGHT
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
       BOOTSCREEN (Hologram Fade-Out)
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
       DATABASE CONNECTION TEST (JSON FIXED)
    -------------------------------------------------------- */
    async testDatabaseConnection() {

        const host = document.getElementById("db_host").value;
        const user = document.getElementById("db_user").value;
        const pass = document.getElementById("db_pass").value;
        const db   = document.getElementById("db_name").value;
        const port = document.getElementById("db_port").value;

        const resultBox = document.getElementById("db_test_result");
        resultBox.innerHTML = "Testing connection...";
        resultBox.style.color = "#d8baff";

        try {
            const response = await fetch("ajax/test_db.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ host, user, pass, db, port })
            });

            const json = await response.json();

            if (json.success === true) {
                resultBox.innerHTML = "Connection SUCCESS: Database is reachable";
                resultBox.style.color = "#00ff88";

                // Save credentials into PHP session
                await fetch("ajax/save_db_session.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ host, user, pass, db, port })
                });

            } else {
                resultBox.innerHTML = "Connection FAILED: " + json.message;
                resultBox.style.color = "#ff6b8a";
            }

        } catch (err) {
            resultBox.innerHTML = "ERROR: " + err.message;
            resultBox.style.color = "#ff6b8a";
        }
    }
};


/* ============================================================
   GLOBAL INITIALIZER
============================================================ */
window.addEventListener("DOMContentLoaded", () => {

    // Active step highlight
    WLInstaller.highlightCurrentStep();

    // Bootscreen fade-out
    WLInstaller.initBootscreen();

    // Language dropdown: close when clicking outside
    document.addEventListener("click", function(e) {
        const menu = document.getElementById("langMenu");
        const trigger = document.querySelector(".lang-trigger");

        if (!menu || !trigger) return;

        // Klick außerhalb → Menü schließen
        if (!trigger.contains(e.target)) {
            menu.classList.remove("show");
        }
    });
});
