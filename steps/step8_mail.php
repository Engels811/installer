<?php
StepManager::mustCompleteBefore("mail");
StepManager::complete("mail");

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("mail_settings") ?></h3>

    <!-- SMTP HOST -->
    <label><?= $lang::get("smtp_host") ?></label>
    <input id="mail_host" type="text" placeholder="smtp.example.com">

    <!-- SMTP PORT -->
    <label><?= $lang::get("smtp_port") ?></label>
    <input id="mail_port" type="number" placeholder="587">

    <!-- SMTP USERNAME -->
    <label><?= $lang::get("smtp_user") ?></label>
    <input id="mail_user" type="text">

    <!-- SMTP PASSWORD -->
    <label><?= $lang::get("smtp_pass") ?></label>
    <input id="mail_pass" type="password">

    <!-- BUTTONS -->
    <div style="margin-top: 25px; display: flex; gap: 12px;">

        <!-- BACK BUTTON -->
        <a class="btn-icon btn-small"
           href="index.php?step=settings&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- NEXT BUTTON -->
        <a class="btn-icon"
           href="index.php?step=cache&lang=<?= $currentLang ?>">
            <span class="icon">▶</span>
            <?= $lang::get("next") ?>
        </a>

    </div>
</div>
