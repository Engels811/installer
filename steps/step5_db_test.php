<?php
StepManager::mustCompleteBefore("db_test");
StepManager::complete("db_test");

$lang        = Language::class;
$currentLang = Language::active();
?>

<!-- TERMINAL OUTPUT BOX – GANZ OBEN -->
<div id="db_terminal" class="terminal hidden">
    <div class="terminal-header">
        <span class="dot red"></span>
        <span class="dot yellow"></span>
        <span class="dot green"></span>
        <span class="title">WonderLife Networks DB Diagnostic Terminal</span>
    </div>
    <div id="terminal_output" class="terminal-output"></div>
</div>

<!-- PANEL DARUNTER – WIRD AUTOMATISCH NACH UNTEN GESCHOBEN -->
<div class="panel panel-shifted">

    <h3><?= $lang::get("db_test_title") ?></h3>
    <p><?= $lang::get("db_test_info") ?></p>

    <!-- BUTTONS -->
    <div style="margin-top: 25px; display: flex; gap: 12px;">

        <a class="btn-icon btn-small"
           href="index.php?step=database&lang=<?= $currentLang ?>">
            <span class="icon">◀</span> <?= $lang::get("back") ?>
        </a>

        <a class="btn-icon btn-green"
           onclick="WLN_DBTester.start()">
            <span class="icon">🗄️</span> Verbindung herstellen
        </a>

        <a id="next_btn"
           class="btn-icon disabled"
           style="opacity:0.4; pointer-events:none;"
           href="index.php?step=admin&lang=<?= $currentLang ?>">
            <span class="icon">▶</span> <?= $lang::get("next") ?>
        </a>

    </div>

</div>

<!-- NOTIFICATION ENGINE -->
<script src="/install/assets/js/notify.js"></script>

<!-- TERMINAL ENGINE -->
<link rel="stylesheet" href="/install/assets/css/terminal.css">
<script src="/install/assets/js/db_terminal.js"></script>

<!-- DB TESTER -->
<script src="/install/assets/js/WLN_DBTester.js"></script>

<!-- PANEL OFFSET FIX -->
<style>
    .panel-shifted {
        margin-top: 35px; /* Panel sitzt tiefer unter Terminal */
        position: relative;
        z-index: 10;
    }
</style>
