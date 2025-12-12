<?php
/* ============================================================
   WONDERLIFE INSTALLER — STEP 4: DATABASE CONFIG (FINAL v3)
   Verwendet FULL TEST (test_db_full.php)
============================================================ */

if (!isset($_SESSION)) session_start();

/* Default Host */
if (empty($_SESSION["db_host"])) {
    $_SESSION["db_host"] = "localhost";
}
?>

<div class="panel">
    <h3><?= t("db_title") ?></h3>
    <p><?= t("db_info") ?></p>

    <form id="dbForm" onsubmit="return false;">

        <label>Hostname</label>
        <input id="db_host" type="text"
               value="<?= $_SESSION["db_host"] ?? 'localhost' ?>"
               placeholder="localhost" required>

        <label>Datenbank-Benutzer</label>
        <input id="db_user" type="text"
               value="<?= $_SESSION["db_user"] ?? '' ?>" required>

        <label>Passwort</label>
        <input id="db_pass" type="password"
               value="<?= $_SESSION["db_pass"] ?? '' ?>">

        <label>Datenbankname</label>
        <input id="db_name" type="text"
               value="<?= $_SESSION["db_name"] ?? '' ?>" required>

        <!-- EINZIGER BUTTON -->
        <button type="button" id="btnTestDB" class="btn-primary" style="margin-top:20px;">
            Verbindung testen
        </button>

        <!-- Ergebnisbox -->
        <div id="testResult" style="
            margin-top: 18px;
            padding: 10px 0;
            color: #a74bff;
            font-family: Consolas, monospace;
            font-size: 15px;
            min-height: 20px;">
        </div>

    </form>
</div>

<!-- JAVASCRIPT STEP4 -->
<script>
function writeResult(msg, color = "#a74bff") {
    const box = document.getElementById("testResult");
    box.innerHTML = msg;
    box.style.color = color;
}

document.getElementById("btnTestDB").addEventListener("click", async function () {

    const host = document.getElementById("db_host").value;
    const user = document.getElementById("db_user").value;
    const pass = document.getElementById("db_pass").value;
    const name = document.getElementById("db_name").value;

    writeResult("Führe erweiterten Verbindungstest durch…");

    /* ======================================================
       1) FULL DB TEST: test_db_full.php
    ====================================================== */
    let response = await fetch("/install/ajax/test_db_full.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ host, user, pass, name })
    });

    let raw = await response.text();
    console.log("FULL TEST RAW RESPONSE:", raw);

    let data;
    try {
        data = JSON.parse(raw);
    } catch (err) {
        writeResult("Serverfehler: ungültige JSON-Antwort.", "#ff0040");
        return;
    }

    /* ======================================================
       2) Fehler
    ====================================================== */
    if (!data.success) {
        writeResult("FEHLER: " + (data.message ?? "Unbekannter Fehler"), "#ff0040");
        return;
    }

    /* ======================================================
       3) ERFOLG
    ====================================================== */
    writeResult("VERBINDUNG ERFOLGREICH ✓", "#6a0499ff");

    // SESSION speichern
    await fetch("/install/ajax/save_db_session.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ host, user, pass, name })
    });

    // Weiterleitung
    await new Promise(r => setTimeout(r, 600));
    window.location = "?step=db_test";
});
</script>
