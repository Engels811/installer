<?php
StepManager::mustCompleteBefore("realtime");
StepManager::complete("realtime");

$lang = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3>Realtime Engine • WebSocket Support Check</h3>

    <p>
        Das WonderLife Mega System kann in Echtzeit arbeiten – z.B. für:
        <br>• Live Notifications<br>
        • Agents Live Status<br>
        • Dashboard Updates<br>
        • Discord Sync
        <br><br>
        Dein Server wird jetzt geprüft, ob er <strong>WebSockets unterstützt</strong>.
    </p>

    <a class="btn-icon btn-green" onclick="runRealtimeTest()">
        <span class="icon">⚡</span>
        WebSocket Test starten
    </a>

    <!-- TERMINAL OUTPUT -->
    <div id="ws_terminal" class="terminal hidden">
        <div class="terminal-header">
            <div class="dot red"></div>
            <div class="dot yellow"></div>
            <div class="dot green"></div>
            <span class="title">Realtime Engine – Diagnostic</span>
        </div>

        <div class="terminal-output" id="ws_output">
            <!-- Lines will be added dynamically -->
        </div>
    </div>

    <!-- BACK BUTTON -->
    <a class="btn-icon btn-small"
       href="index.php?step=db_test&lang=<?= $currentLang ?>">
        <span class="icon">◀</span>
        <?= $lang::get("back") ?>
    </a>

    <!-- NEXT BUTTON -->
    <a id="ws_next_btn"
       class="btn-icon"
       style="opacity: 0.3; pointer-events: none;"
       href="index.php?step=admin&lang=<?= $currentLang ?>">
        <span class="icon">▶</span>
        Weiter
    </a>
</div>
