//Last Change:    >
//Reason:         

// Statische Navbar oben einblenden
document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.querySelector("ul.navbar");
    if (navbar) {
        navbar.style.position = "fixed";
        navbar.style.top = "0";
        navbar.style.width = "100%";
        navbar.style.zIndex = "1000";
    }
});

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
