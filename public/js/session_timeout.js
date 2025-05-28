function checkSessionTimeout() {
    const lastActivity = parseInt(localStorage.getItem('last_activity') || '0');
    const currentTime = Math.floor(Date.now() / 1000);
    
    if (lastActivity && (currentTime - lastActivity > 300)) {
        window.location.href = 'auth.php';
    }
}

// Aktualisiere last_activity
function updateLastActivity() {
    localStorage.setItem('last_activity', Math.floor(Date.now() / 1000));
}

// Initialer Setup
document.addEventListener('DOMContentLoaded', () => {
    updateLastActivity();
    
    // Prüfe alle 5 Sekunden auf Timeout
    setInterval(checkSessionTimeout, 5000);
    
    // Aktualisiere last_activity bei User-Interaktion
    document.addEventListener('click', updateLastActivity);
    document.addEventListener('keypress', updateLastActivity);
    document.addEventListener('scroll', updateLastActivity);
    document.addEventListener('mousemove', updateLastActivity);
});