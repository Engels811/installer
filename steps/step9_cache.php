<?php
StepManager::mustCompleteBefore("cache");
StepManager::complete("cache");

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("cache_settings") ?></h3>

    <!-- Cache Method -->
    <label><?= $lang::get("cache_method") ?></label>
    <select id="cache_method">
        <option value="file"><?= $lang::get("cache_file") ?></option>
        <option value="redis"><?= $lang::get("cache_redis") ?></option>
    </select>

    <!-- BUTTONS -->
    <div style="margin-top: 25px; display: flex; gap: 12px;">

        <!-- BACK BUTTON -->
        <a class="btn-icon btn-small"
           href="index.php?step=mail&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- NEXT BUTTON -->
        <a class="btn-icon"
           href="index.php?step=summary&lang=<?= $currentLang ?>">
            <span class="icon">▶</span>
            <?= $lang::get("next") ?>
        </a>

    </div>
</div>
