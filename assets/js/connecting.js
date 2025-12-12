/* ============================================================
   WONDERLIFE MEGA SYSTEM – CONNECTING ENGINE (v1.0)
   Steuert:
   • Holo-Overlay ein/aus
   • Animated Connecting Text
   • Optionalen Callback beim Abschluss
============================================================ */

const WLNConnecting = {

    overlay: null,
    textElement: null,
    interval: null,

    init() {
        this.overlay = document.getElementById("wln-connect-overlay");
        this.textElement = document.getElementById("connect-text");
    },

    /* --------------------------------------------------------
       OVERLAY ANZEIGEN
    -------------------------------------------------------- */
    show(message = "Connecting…") {
        if (!this.overlay) this.init();

        this.textElement.innerText = message;
        this.overlay.classList.remove("hidden");

        this.animateDots();
    },

    /* --------------------------------------------------------
       OVERLAY VERSTECKEN
    -------------------------------------------------------- */
    hide() {
        if (!this.overlay) return;

        this.overlay.classList.add("hidden");

        if (this.interval) {
            clearInterval(this.interval);
            this.interval = null;
        }
    },

    /* --------------------------------------------------------
       ANIMIERTER TEXT: "Connecting.", "Connecting..", ...
    -------------------------------------------------------- */
    animateDots() {
        let base = this.textElement.innerText.replace(/\.*$/, "");
        let dots = 0;

        this.interval = setInterval(() => {
            dots = (dots + 1) % 4;
            this.textElement.innerText = base + ".".repeat(dots);
        }, 420);
    },

    /* --------------------------------------------------------
       EINE FETCH-AKTION MIT AUTO-CONNECTING WRAPPER
       Beispiel:
       WLNConnecting.run(() => fetch("/install/test.php"))
-------------------------------------------------------- */
    async run(action, msg = "Connecting…") {

        this.show(msg);

        try {
            let result = await action();
            this.hide();
            return result;
        } catch (e) {
            this.hide();
            console.error("Connecting error:", e);
            throw e;
        }
    }
};

document.addEventListener("DOMContentLoaded", () => WLNConnecting.init());
