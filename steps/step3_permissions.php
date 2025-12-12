<?php
StepManager::mustCompleteBefore("permissions");
StepManager::complete("permissions");

$lang = Language::class;
$currentLang = Language::active();

$perm = Permissions::check();
?>

<div class="panel">
    <h3><?= $lang::get("permissions") ?></h3>

    <?php foreach ($perm as $folder => $ok): ?>
        <div class="status-box">
            <div class="status-text"><?= $folder ?></div>

            <div class="<?= $ok ? 'status-ok' : 'status-bad' ?>">
                <?= $ok ? $lang::get("ok") : $lang::get("fail") ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Zurück -->
    <a class="btn-icon btn-small"
       href="index.php?step=php_extensions&lang=<?= $currentLang ?>">
        <span class="icon">◀</span>
        <?= $lang::get("back") ?>
    </a>

    <!-- Weiter -->
    <a class="btn-icon"
       href="index.php?step=database&lang=<?= $currentLang ?>">
        <span class="icon">▶</span>
        <?= $lang::get("next") ?>
    </a>
</div>
