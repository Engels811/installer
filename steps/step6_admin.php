<?php
StepManager::mustCompleteBefore("admin");
StepManager::complete("admin");

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("admin_account") ?></h3>

    <form id="admin_form">

        <!-- Benutzername -->
        <label><?= $lang::get("username") ?></label>
        <input id="admin_user" required type="text" autocomplete="off">

        <!-- E-Mail -->
        <label><?= $lang::get("email") ?></label>
        <input id="admin_email" required type="email" autocomplete="off">

        <!-- Passwort -->
        <label><?= $lang::get("password") ?></label>
        <input id="admin_pass" required type="password">
    </form>

    <!-- BUTTONS -->
    <div style="margin-top: 20px; display: flex; gap: 12px;">

        <!-- BACK -->
        <a class="btn-icon btn-small"
           href="index.php?step=db_test&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- NEXT -->
        <a class="btn-icon"
           href="index.php?step=settings&lang=<?= $currentLang ?>">
            <span class="icon">▶</span>
            <?= $lang::get("next") ?>
        </a>

    </div>
</div>
