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

        // Stärke prüfen
        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[a-z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const barColors = ["#e74c3c", "#e67e22", "#f1c40f", "#2ecc71", "#27ae60"];
        const labels = ["Sehr schwach", "Schwach", "Okay", "Gut", "Sehr gut"];

        // Stärke-Balken aktualisieren
        strengthBar.innerHTML = `<div style="
            width: ${(strength * 20)}%;
            background-color: ${barColors[strength - 1] || '#e74c3c'};
            height: 100%;
            border-radius: 4px;
            transition: width 0.4s ease, background-color 0.4s ease;
        "></div>`;

        // Text anzeigen
        strengthText.textContent = labels[strength - 1] || "";
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
function preventSpecialChars(input, allowAt = false, allowSpecialChars = false) {
    if (allowSpecialChars) return; // Keine Einschränkung für Passwörter
    const regex = allowAt ? /[^a-zA-Z0-9@._-]/g : /[^a-zA-Z0-9._-]/g;
    if (regex.test(input.value)) {
        // Nur Zeichen entfernen, keine Warnung anzeigen
        input.value = input.value.replace(regex, "");
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Alle Inputs außer Email und Passwort
    document.querySelectorAll('input[type="text"]').forEach(function(input) {
        input.addEventListener("input", function() {
            preventSpecialChars(input, false, false);
        });
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
