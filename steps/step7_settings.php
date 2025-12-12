<?php
StepManager::mustCompleteBefore(7);
StepManager::complete(7);

$lang        = Language::class;
$currentLang = Language::active();
?>

<div class="panel">
    <h3><?= $lang::get("system_settings") ?></h3>

    <!-- SYSTEM NAME -->
    <label><?= $lang::get("system_name") ?></label>
    <input id="sys_name" value="WonderLife Mega System" type="text">

    <!-- BASE URL -->
    <label><?= $lang::get("base_url") ?></label>
    <input id="sys_url" type="text"
           value="<?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ?>">

    <!-- TIMEZONE -->
    <label><?= $lang::get("timezone") ?></label>
    <select id="sys_tz">
        <?php
        $currentTz = date_default_timezone_get();
        foreach (timezone_identifiers_list() as $tz):
        ?>
            <option <?= $tz === $currentTz ? 'selected' : '' ?>>
                <?= $tz ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- BUTTONS -->
    <div style="margin-top: 25px; display: flex; gap: 12px;">

        <!-- BACK BUTTON -->
        <a class="btn-icon btn-small"
           href="index.php?step=admin&lang=<?= $currentLang ?>">
            <span class="icon">◀</span>
            <?= $lang::get("back") ?>
        </a>

        <!-- NEXT BUTTON -->
        <a class="btn-icon"
           href="index.php?step=mail&lang=<?= $currentLang ?>">
            <span class="icon">▶</span>
            <?= $lang::get("next") ?>
        </a>

    </div>
</div>
