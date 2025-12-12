<?php
if (!isset($_SESSION)) session_start();

/* Sprache */
$lang = $_GET["lang"] ?? ($_SESSION["installer_lang"] ?? "de");
$_SESSION["installer_lang"] = $lang;
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WLN Booting…</title>

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS FILES -->
    <link rel="stylesheet" href="assets/css/wln-core.css">
    <link rel="stylesheet" href="assets/css/wln-boot.css">
    <link rel="stylesheet" href="assets/css/wln-lang.css">
    <link rel="stylesheet" href="assets/css/wln-animations.css">

    <!-- HIDE FOOTER ON BOOT SCREEN -->
    <style>
        /* Footer komplett verstecken */
        .wln-footer,
        .footer-center-block,
        .footer-space,
        footer,
        [class*="footer"] {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
            position: absolute !important;
            left: -9999px !important;
        }
        
        /* Body overflow hidden */
        body.boot-body {
            overflow: hidden !important;
            position: relative;
        }

        /* Boot-Screen auf volle Höhe */
        #wln-boot {
            min-height: 100vh;
            height: 100vh;
        }
    </style>

    <!-- JS -->
    <script src="assets/js/app.js" defer></script>
</head>

<body class="boot-body">

<!-- ============================================================
     LANGUAGE SWITCH (TOP RIGHT)
============================================================ -->
<div class="lang-switch">
    <div class="lang-current" onclick="WLInstaller.toggleLanguageMenu()">
        <?= $lang === 'de' ? '🇩🇪' : '🇬🇧' ?>
        <span><?= strtoupper($lang) ?></span>
        <span class="lang-arrow">▼</span>
    </div>

    <div id="langMenu" class="lang-menu">
        <div class="lang-option <?= $lang === 'de' ? 'active-lang' : '' ?>"
             onclick="WLInstaller.setLanguage('de')">
            🇩🇪 DE
        </div>

        <div class="lang-option <?= $lang === 'en' ? 'active-lang' : '' ?>"
             onclick="WLInstaller.setLanguage('en')">
            🇬🇧 EN
        </div>
    </div>
</div>


<!-- ============================================================
     WLN NEON CYBER BOOTSCREEN v5 (FINAL)
     Dauer: 15 Sekunden
     - Progress: 13 Sekunden
     - Fade-Out: 1.5 Sekunden
     - Redirect: Nach 15 Sekunden
============================================================ -->
<div id="wln-boot">
    <div class="boot-container">

        <!-- LOGO -->
        <div class="boot-logo">
            <img src="https://i.ibb.co/27L9nkfN/wln-logo-outline.png" alt="WLN Logo">
        </div>

        <!-- TITLE (HEADER) -->
        <header class="boot-title">WonderLife Network</header>

        <!-- SUBTITLE -->
        <div class="boot-subtitle">
            <?= $lang === 'de' 
                ? 'Initialisiere WonderLife Mega System…' 
                : 'Initializing WonderLife Mega System…' ?>
        </div>

        <!-- HOLOGRAFISCHER RING -->
        <div class="boot-ring">
            <div class="ring-glow"></div>
            <div class="ring-core"></div>
        </div>

        <!-- PROGRESSBAR (macOS Style) -->
        <div class="boot-progress">
            <div class="boot-progress-bar"></div>
        </div>

        <!-- LOADING DOTS -->
        <div class="boot-loading-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>

    <!-- SCANLINE EFFECT -->
    <div class="boot-scanline"></div>
</div>


<!-- ============================================================
     AUTO-REDIRECT & FOOTER REMOVAL
============================================================ -->
<script>
// ========================================
// FOOTER SOFORT ENTFERNEN (ALLE VARIANTEN)
// ========================================
(function killFooter() {
    // Funktion zum Entfernen
    function removeFooters() {
        // Alle möglichen Footer-Selektoren
        const selectors = [
            '.wln-footer',
            '.footer-center-block',
            '.footer-space',
            'footer',
            '[class*="footer"]',
            '[class*="Footer"]'
        ];
        
        selectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => {
                if (el) {
                    el.remove();
                }
            });
        });
    }
    
    // Sofort ausführen
    removeFooters();
    
    // Nach DOM geladen nochmal ausführen
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', removeFooters);
    }
    
    // Alle 100ms für 2 Sekunden prüfen (falls Footer verzögert geladen wird)
    let checks = 0;
    const interval = setInterval(() => {
        removeFooters();
        checks++;
        if (checks >= 20) {
            clearInterval(interval);
        }
    }, 100);
})();


// ========================================
// BOOT-SCREEN REDIRECT (15 SEKUNDEN)
// ========================================
setTimeout(() => {
    window.location.href = "index.php?step=requirements&lang=<?= $lang ?>";
}, 15000);


// ========================================
// LOADING-STEPS IN CONSOLE (15 SEKUNDEN)
// ========================================
const steps = [
    { time: 0,     text: "<?= $lang === 'de' ? 'System wird initialisiert...' : 'Initializing system...' ?>" },
    { time: 2000,  text: "<?= $lang === 'de' ? 'Datenbank-Verbindung wird vorbereitet...' : 'Preparing database connection...' ?>" },
    { time: 4000,  text: "<?= $lang === 'de' ? 'Module werden geladen...' : 'Loading modules...' ?>" },
    { time: 6000,  text: "<?= $lang === 'de' ? 'Konfiguration wird geprüft...' : 'Checking configuration...' ?>" },
    { time: 8000,  text: "<?= $lang === 'de' ? 'Authentifizierung wird konfiguriert...' : 'Configuring authentication...' ?>" },
    { time: 10000, text: "<?= $lang === 'de' ? 'Sicherheit wird initialisiert...' : 'Initializing security...' ?>" },
    { time: 12000, text: "<?= $lang === 'de' ? 'Dashboard wird aktiviert...' : 'Activating dashboard...' ?>" },
    { time: 14000, text: "<?= $lang === 'de' ? 'Fertig! Weiterleitung...' : 'Done! Redirecting...' ?>" }
];

steps.forEach(step => {
    setTimeout(() => {
        console.log(`[WLN Boot] ${step.text}`);
    }, step.time);
});
</script>

</body>
</html>
