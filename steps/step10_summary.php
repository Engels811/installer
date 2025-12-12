<?php
StepManager::mustCompleteBefore("summary");
StepManager::complete("summary");

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("summary_title") ?></h3>
    <p><?= $lang::get("summary_text") ?></p>

    <div style="margin-top: 30px; display: flex; gap: 12px;">

        <!-- BACK BUTTON -->
        <a class="btn-icon btn-small"
           href="index.php?step=cache&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- INSTALL NOW BUTTON -->
        <a class="btn-icon btn-green"
           href="index.php?step=install&lang=<?= $currentLang ?>">
            <span class="icon">🚀</span>
            <?= $lang::get("install_now") ?>
        </a>

    </div>
</div>
