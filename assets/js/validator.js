/* ==========================================================
   FORM VALIDATOR
========================================================== */

function isEmailValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isPasswordStrong(pw) {
    return pw.length >= 8 && /\d/.test(pw) && /[A-Z]/.test(pw);
}

function validateInputs(formQuery) {
    const form = document.querySelector(formQuery);
    if (!form) return true;

    let valid = true;

    form.querySelectorAll("input[required]").forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = "#ff004c";
            input.style.boxShadow = "0 0 12px #ff004c";
            valid = false;
        } else {
            input.style.borderColor = "";
            input.style.boxShadow = "";
        }
    });

    return valid;
}
