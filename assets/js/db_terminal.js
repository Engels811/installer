document.addEventListener("DOMContentLoaded", () => {
    // Terminal wird NICHT automatisch gestartet – WLInstaller ruft runTerminal() auf.
});

async function runTerminal() {

    const term = document.getElementById("db_terminal");
    const out  = document.getElementById("terminal_output");

    // Terminal sichtbar machen
    term.classList.remove("hidden", "success", "error");
    out.innerHTML = "";

    // Helper: animierte Terminal-Zeile
    function line(text, delay = 600) {
        return new Promise(resolve => {
            out.innerHTML += `<div class="line">> ${text}</div>`;
            out.scrollTop = out.scrollHeight;
            setTimeout(resolve, delay);
        });
    }

    // VISUELLE ANIMATION
    await line("Starte Datenbankprüfung…");
    await line("Initialisiere Verbindungsmodule…");
    await line("Lade Konfiguration…");
    await line("Verbinde zum Datenbankserver…");
    await line("Authentifiziere Benutzer…");
    await line("Sende Ping zur Datenbank…");
    await line("Führe Testabfrage aus…");

    // ------------------------------------------------------------------
    // REALER TEST → test_db_full.php
    // ------------------------------------------------------------------
    let response = await fetch("/install/ajax/test_db_full.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ check: true })
    });

    let data = await response.json();

    // PHP Steps ausgeben
    if (data.steps && Array.isArray(data.steps)) {
        for (let s of data.steps) {
            await line(s, 250);
        }
    }

    // ------------------------------------------------------------------
    // Ergebnis
    // ------------------------------------------------------------------
    if (data.success === true) {

        term.classList.add("success");

        await line("Verbindung erfolgreich ✓", 200);
        await line("MySQL-Handshake abgeschlossen ✓", 200);
        await line("Systemstatus: OK ✓", 200);

        // NEXT BUTTON freischalten
        let next = document.getElementById("next_btn");
        if (next) {
            next.style.opacity = "1";
            next.style.pointerEvents = "auto";
        }

    } else {

        term.classList.add("error");

        await line("Verbindung FEHLGESCHLAGEN ✖", 200);
        await line("MySQL Antwort:", 200);
        await line(data.message ?? "Unbekannter Fehler", 400);
    }
}
