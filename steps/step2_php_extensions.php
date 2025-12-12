<?php
StepManager::mustCompleteBefore("php_extensions");
StepManager::complete("php_extensions");

$ext = Requirements::checkExtensions();
$lang = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("extensions") ?></h3>

    <?php foreach ($ext as $name => $ok): ?>
        <div class="status-box">
            <div class="status-text"><?= strtoupper($name) ?></div>

            <div class="<?= $ok ? 'status-ok' : 'status-bad' ?>">
                <?= $ok ? $lang::get("ok") : $lang::get("fail") ?>
            </div>
        </div>
    <?php endforeach; ?>

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
