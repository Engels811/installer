/* ============================================================
   WONDERLIFE NETWORK – DB TESTER (FINAL v5)
============================================================ */

const WLN_DBTester = {

    running: false,

    async start() {
        if (this.running) return;
        this.running = true;

        WLN_Terminal.show();
        WLN_Terminal.clear();

        WLN_Terminal.write("Starte Datenbankprüfung…");
        await this.sleep(400);
        WLN_Terminal.write("Initialisiere Verbindungsmodule…");
        await this.sleep(400);
        WLN_Terminal.write("Lade Zugangsdaten…");
        await this.sleep(400);

        this.realTest();
    },

    async realTest() {

        WLN_Terminal.write("Sende Testanfrage an Backend…");

        let response = await fetch("/install/ajax/test_db_full.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ check: true })
        });

        let raw = await response.text();
        console.log("RAW Response:", raw);

        let data;
        try {
            data = JSON.parse(raw);
        } catch (e) {
            WLN_Terminal.error();
            WLN_Terminal.write("FEHLER: Ungültige JSON-Antwort vom Server.");
            WLNotify.error("Installer-Fehler: Ungültige JSON-Antwort");
            this.running = false;
            return;
        }

        // Backend liefert steps[]?
        if (data.steps) {
            for (let s of data.steps) {
                WLN_Terminal.write(s);
                await this.sleep(200);
            }
        }

        // Erfolg
        if (data.success === true) {

            WLN_Terminal.success();

            WLN_Terminal.write("--------------------------------------");
            WLN_Terminal.write("✔ Verbindung erfolgreich");
            WLN_Terminal.write("✔ MySQL Version: " + data.version);
            WLN_Terminal.write("✔ Datenbank existiert: " + (data.db_exists ? "Ja" : "Nein"));
            WLN_Terminal.write("✔ Tabellen: " + data.tables);
            WLN_Terminal.write("✔ CREATE Rechte: " + (data.can_create_db ? "Ja" : "Nein"));
            WLN_Terminal.write("--------------------------------------");

            // Weiter-Button aktivieren
            const next = document.getElementById("next_btn");
            next.style.opacity = "1";
            next.style.pointerEvents = "auto";

            WLNotify.success("Datenbank erfolgreich verbunden!");

        } else {

            WLN_Terminal.error();
            WLN_Terminal.write("❌ VERBINDUNG FEHLGESCHLAGEN");
            WLN_Terminal.write("Fehler: " + (data.error ?? "Unbekannt"));
            WLN_Terminal.write("--------------------------------------");

            WLNotify.error("Fehler bei der Verbindung zur Datenbank!");
        }

        this.running = false;
    },

    sleep(ms) {
        return new Promise(r => setTimeout(r, ms));
    }
};
