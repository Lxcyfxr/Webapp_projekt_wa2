//Last Change:    >
//Reason:         >


var sign_in_btn = document.querySelector("#sign-in-btn");
var sign_up_btn = document.querySelector("#sign-up-btn");
var container = document.querySelector(".container");

sign_up_btn.addEventListener("click", function () {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", function () {
    container.classList.remove("sign-up-mode");
});

// Passwort-Stärkebalken (neu)
var passwordInput = document.querySelector("#register-password");
var strengthBar = document.querySelector("#strength-bar");
var strengthText = document.querySelector("#strength-text");

if (passwordInput) {
    passwordInput.addEventListener("input", function () {
        const val = passwordInput.value;
        let strength = 0;

        const hasLower = /[a-z]/.test(val);
        const hasUpper = /[A-Z]/.test(val);
        const hasNumber = /[0-9]/.test(val);
        const hasSpecial = /[^A-Za-z0-9]/.test(val);

        // Sehr schwach: mindestens 1 Buchstabe
        if (/[a-zA-Z]/.test(val)) strength = 1;

        // Schwach: mindestens 5 Zeichen
        if (val.length >= 5) strength = 2;

        // Okay: mindestens 8 Zeichen
        if (val.length >= 8) strength = 3;

        // Gut: mindestens 8 Zeichen UND Groß- und Kleinbuchstaben UND (Zahl ODER Sonderzeichen)
        if (
            val.length >= 8 &&
            hasLower && hasUpper &&
            (hasNumber || hasSpecial)
        ) {
            strength = 4;
        }

        // Sehr gut: mindestens 8 Zeichen UND Groß- und Kleinbuchstaben UND Zahl UND Sonderzeichen
        if (
            val.length >= 8 &&
            hasLower && hasUpper &&
            hasNumber && hasSpecial
        ) {
            strength = 5;
        }

        const barColors = ["#e74c3c", "#e67e22", "#f1c40f", "#2ecc71", "#27ae60"];
        const labels = ["Sehr schwach", "Schwach", "Okay", "Gut", "Sehr gut"];

        if (strength > 0) {
            strengthBar.innerHTML = `<div style="
                width: ${(strength * 20)}%;
                background-color: ${barColors[strength - 1] || '#e74c3c'};
                height: 100%;
                border-radius: 4px;
                transition: width 0.4s ease, background-color 0.4s ease;
            "></div>`;
            strengthText.textContent = labels[strength - 1] || "";
        } else {
            strengthBar.innerHTML = "";
            strengthText.textContent = "";
        }
    });
}

function showInputWarning(input, message) {
    let warning = input.nextElementSibling;
    if (!warning || !warning.classList.contains('input-warning')) {
        warning = document.createElement('div');
        warning.className = 'input-warning';
        warning.style.color = '#e74c3c';
        warning.style.fontSize = '0.9em';
        warning.style.marginTop = '4px';
        input.parentNode.insertBefore(warning, input.nextSibling);
    }
    warning.textContent = message;
}

function hideInputWarning(input) {
    let warning = input.nextElementSibling;
    if (warning && warning.classList.contains('input-warning')) {
        warning.remove();
    }
}

// Funktion zur Sonderzeichen-Prüfung
function preventSpecialChars(input, allowAt = false, allowSpecialChars = false, isAddress = false) {
    if (allowSpecialChars) {
        hideInputWarning(input);
        return; // Keine Einschränkung für Passwörter
    }
    let regex;
    if (isAddress) {
        // Erlaubt a-z, A-Z, 0-9, Punkt, Unterstrich, Bindestrich, Leerzeichen und ß
        regex = /[^a-zA-Z0-9._\- ß]/g;
    } else if (allowAt) {
        regex = /[^a-zA-Z0-9@._-]/g;
    } else {
        regex = /[^a-zA-Z0-9._-]/g;
    }
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, "");
        showInputWarning(input, "Sonderzeichen sind hier nicht erlaubt.");
    } else {
        hideInputWarning(input);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Alle Inputs außer Email, Passwort und Adresse
    document.querySelectorAll('input[type="text"]').forEach(function(input) {
        // Prüfen, ob es das Adressfeld ist
        if (input.name === "address") {
            input.addEventListener("input", function() {
                preventSpecialChars(input, false, false, true);
            });
        } else {
            input.addEventListener("input", function() {
                preventSpecialChars(input, false, false, false);
            });
        }
    });

    // Nur Email-Feld
    document.querySelectorAll('input[type="email"]').forEach(function(input) {
        input.addEventListener("input", function() {
            preventSpecialChars(input, true, false);
        });
    });

    // Passworteingabefelder: keine Einschränkung
    document.querySelectorAll('input[type="password"]').forEach(function(input) {
        input.addEventListener("input", function() {
            preventSpecialChars(input, false, true);
        });
    });

    // Login-Felder (IDs aus dem HTML)
    const loginFields = [
        document.querySelector('#username'), // Login-Username
        document.querySelector('#password')  // Login-Passwort
    ];

    loginFields.forEach(function(input) {
        if (input) {
            // Für Passwortfeld keine Einschränkung, für Username wie gehabt
            if (input.type === "password") {
                input.addEventListener("input", function() {
                    preventSpecialChars(input, false, true);
                });
            } else {
                input.addEventListener("input", function() {
                    preventSpecialChars(input, false, false);
                });
            }
        }
    });
});
