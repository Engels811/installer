<?php
StepManager::complete(1); // <- Wichtig: Index 1, nicht Name

$lang = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("requirements_title") ?></h3>

    <!-- PHP Version -->
    <div class="status-box">
        <div class="status-text">
            <?= $lang::get("php_version") ?>: <?= Requirements::getPHPVersion() ?>
        </div>

        <div class="<?= Requirements::checkPHP() ? 'status-ok' : 'status-bad' ?>">
            <?= Requirements::checkPHP() ? $lang::get("ok") : $lang::get("fail") ?>
        </div>
    </div>

    <!-- Navigation -->
    <div style="margin-top: 30px; display: flex; gap: 12px;">
        
        <!-- ZURÜCK -->
        <a class="btn-icon btn-small"
           href="index.php?step=requirements&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- WEITER -->
        <a class="btn-icon"
           href="index.php?step=permissions&lang=<?= $currentLang ?>">
            <span class="icon">▶</span>
            <?= $lang::get("next") ?>
        </a>

    </div>

</div>