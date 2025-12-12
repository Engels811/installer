async function saveDatabaseConfig() {
    const host = document.getElementById("db_host").value;
    const user = document.getElementById("db_user").value;
    const pass = document.getElementById("db_pass").value;
    const name = document.getElementById("db_name").value;

    const formData = new URLSearchParams();
    formData.append("host", host);
    formData.append("user", user);
    formData.append("pass", pass);
    formData.append("name", name);

    let response = await fetch("/install/core/save_db_session.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: formData
    });

    // Reinen Text holen
    let raw = await response.text();
    console.log("RAW RESPONSE:", raw);

    let data;

    // JSON PARSEN (FEHLERFREI)
    try {
        data = JSON.parse(raw);
    } catch(e) {
        alert("Server lieferte ungültiges JSON zurück.");
        return;
    }

    if (!data.success) {
        alert("Fehler: " + data.message);
        return;
    }

    // Weiterleitungs-URL aus JSON
    window.location = data.next;
}
