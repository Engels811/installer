const btnTest = document.getElementById("btnTestDB");
if (btnTest) {
    btnTest.addEventListener("click", async () => {

        const host = document.getElementById("db_host").value;
        const user = document.getElementById("db_user").value;
        const pass = document.getElementById("db_pass").value;
        const name = document.getElementById("db_name").value;

        const resultBox = document.getElementById("testResult");
        resultBox.style.color = "#d88cff";
        resultBox.innerHTML = "Teste Verbindung…";

        // 1) AJAX DB Test
        let response = await fetch("/install/steps/step4_database.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: new URLSearchParams({host, user, pass, name})
        });

        let raw = await response.text();
        console.log("RAW:", raw);

        let data;
        try {
            data = JSON.parse(raw);
        } catch(e) {
            resultBox.innerHTML = "Serverfehler: Ungültige JSON-Antwort.";
            resultBox.style.color = "#ff0040";
            return;
        }

        if (data.status !== "ok") {
            resultBox.innerHTML = "FEHLER: " + data.message;
            resultBox.style.color = "#ff0040";
            return;
        }

        // Erfolgreich
        resultBox.innerHTML = "VERBINDUNG ERFOLGREICH";
        resultBox.style.color = "#00ff96";

        // 2) Session speichern
        await fetch("/install/ajax/save_db_session.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: new URLSearchParams({host, user, pass, name})
        });

        // 3) Auto-Weiterleitung
        setTimeout(() => {
            window.location = "?step=db_test";
        }, 600);

    });
}
