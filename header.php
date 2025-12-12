<?php
/* ============================================================
   WONDERLIFE MEGA SYSTEM INSTALLER v3 — HEADER CORE (FINAL)
   Output-Buffer aktiviert → Keine "headers already sent"-Fehler
============================================================ */
ob_start();

if (!isset($_SESSION)) {
    session_start();
}

$lang            = $_GLOBAL_INSTALL["lang"]         ?? 'en';
$translations    = $_GLOBAL_INSTALL["translations"] ?? [];
$step            = $_GLOBAL_INSTALL["step"]         ?? 'boot';
$steps           = $_GLOBAL_INSTALL["steps"]        ?? [];
$currentIndex    = $_GLOBAL_INSTALL["currentIndex"] ?? 0;
$progressPercent = $_GLOBAL_INSTALL["progressPercent"] ?? 0;

/* ------------------------------------------------------------
   Translation Helpers
------------------------------------------------------------ */
if (!function_exists('t')) {
    function t($key) {
        global $translations;
        return $translations[$key] ?? $key;
    }
}

if (!function_exists('t_short')) {
    function t_short($key) {
        global $translations;
        return $translations[$key . "_short"] ?? ($translations[$key] ?? $key);
    }
}

/* ------------------------------------------------------------
   Step Icons
------------------------------------------------------------ */
$stepIcons = [
    "boot"           => "◎",
    "requirements"   => "⚙️",
    "php_extensions" => "🧩",
    "permissions"    => "🔐",
    "database"       => "🗄️",
    "db_test"        => "🔍",
    "admin"          => "👤",
    "settings"       => "🛠️",
    "mail"           => "✉️",
    "cache"          => "♻️",
    "summary"        => "📄",
    "install"        => "🚀",
    "finish"         => "✨"
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t("installer_title") ?></title>

    <!-- WLN CORE STYLES -->
    <link rel="stylesheet" href="assets/css/wln-core.css">
    <link rel="stylesheet" href="assets/css/wln-panels.css">
    <link rel="stylesheet" href="assets/css/wln-buttons.css">
    <link rel="stylesheet" href="assets/css/wln-sidebar.css">
    <link rel="stylesheet" href="assets/css/wln-lang.css">
    <link rel="stylesheet" href="assets/css/wln-animations.css">
    <link rel="stylesheet" href="assets/css/wln-boot.css">

    <!-- WLN SCRIPTS -->
    <script src="assets/js/installer.js" defer></script>
</head>

<body>

<!-- ============================================================
     LANGUAGE SWITCHER
============================================================ -->
<div class="lang-switch">
    <div class="lang-current lang-trigger" onclick="WLInstaller.toggleLanguageMenu()">
        <?= $lang === 'de' ? '🇩🇪' : '🇬🇧' ?>
        <span><?= strtoupper($lang) ?></span>
        <span class="lang-arrow">▼</span>
    </div>

    <div id="langMenu" class="lang-menu">
        <div class="lang-option <?= $lang === 'de' ? 'active-lang' : '' ?>"
             onclick="WLInstaller.setLanguage('de')">
            🇩🇪 DEUTSCH
        </div>

        <div class="lang-option <?= $lang === 'en' ? 'active-lang' : '' ?>"
             onclick="WLInstaller.setLanguage('en')">
            🇬🇧 ENGLISH
        </div>
    </div>
</div>


<!-- ============================================================
     BOOTSCREEN (Nur Step "boot")
============================================================ -->
<?php if ($step === "boot"): ?>
<div id="wl-boot">
    <div class="boot-center">
        <div class="boot-holo">
            <div class="boot-ring"></div>
            <div class="boot-core">◎</div>
            <div class="boot-scan"></div>
        </div>
        <p class="boot-text"><?= t('boot_initializing') ?></p>
    </div>
</div>
<?php endif; ?>


<!-- ============================================================
     PROGRESS BAR
============================================================ -->
<div class="wln-progress">
    <div class="wln-progress-bar" style="width: <?= intval($progressPercent) ?>%;"></div>
</div>


<!-- ============================================================
     MAIN WRAPPER
============================================================ -->
<div class="installer-wrapper">

    <!-- ========================================================
         SIDEBAR NAVIGATION
    ========================================================= -->
    <div class="installer-sidebar">

        <div class="logo-small">
            <img src="https://i.ibb.co/27L9nkfN/wln-logo-outline.png" alt="WLN Installer">
        </div>

        <ul class="step-list">
            <?php foreach ($steps as $i => $stepKey): ?>
            <?php
                $active = ($stepKey === $step);
                $done   = ($i < $currentIndex);
            ?>
            <li class="<?= $active ? 'active' : '' ?> <?= $done ? 'done' : '' ?>"
                data-step="<?= $stepKey ?>"
                onclick="window.location='?step=<?= $stepKey ?>&lang=<?= $lang ?>'">

                <span class="step-icon"><?= $stepIcons[$stepKey] ?></span>
                <?= t_short($stepKey) ?>

                <?php if ($done): ?>
                    <span class="check">✔</span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- ========================================================
         CONTENT AREA START
============================================================ -->
<div class="installer-content step-animate">
