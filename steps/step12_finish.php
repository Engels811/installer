<?php
StepManager::mustCompleteBefore("finish");
StepManager::complete("finish");

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">

    <h3><?= $lang::get("finish_title") ?></h3>

    <p><?= $lang::get("finish_text") ?></p>

    <div style="margin-top: 25px;">
        <a class="btn-icon btn-green"
           href="/?lang=<?= $currentLang ?>">
            <span class="icon">✨</span>
            <?= $lang::get("go_to_website") ?>
        </a>
    </div>

</div>
