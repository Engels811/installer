/* ==========================================================
   LANGUAGE ENGINE
========================================================== */

function getLanguage() {
    return sessionStorage.getItem("installer_lang") ||
           localStorage.getItem("installer_lang") ||
           "en";
}

// Optional: live translation mapping could be added here
