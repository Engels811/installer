<?php
StepManager::mustCompleteBefore("install");
StepManager::complete("install");

$lang        = Language::class;
$currentLang = Language::active();

/* ============================================================
   REQUIRED SESSION VALUES
   (Alles, was der Installer wirklich braucht)
============================================================ */
$requiredKeys = [
    "db_host",
    "db_user",
    "db_pass",
    "db_name",
    "db_port",
    "admin_user",
    "admin_email",
    "admin_pass",
];

/* ----- OPTIONAL: REALTIME ENGINE RESULT (wenn genutzt) ----- */
if (isset($_SESSION["ws_supported"])) {
    $requiredKeys[] = "ws_supported";
}

/* ----- Prüfen ob alles da ist ----- */
foreach ($requiredKeys as $key) {
    if (!isset($_SESSION[$key]) || $_SESSION[$key] === "") {

        echo "<div class='panel'>
                <h3 style='color:#ff6b8a;'>Installation Error</h3>
                <p>Missing required installer value: <strong>{$key}</strong></p>
                <p>Please go back and complete all steps correctly.</p>

                <a class='btn-icon btn-red'
                   href='index.php?step=database&lang={$currentLang}'>
                   <span class='icon'>◀</span> Back to Database Step
                </a>
              </div>";

        return;
    }
}

/* ============================================================
   WRITE CONFIG FILE
============================================================ */
try {
    $config = [
        "host" => $_SESSION["db_host"],
        "db"   => $_SESSION["db_name"],
        "user" => $_SESSION["db_user"],
        "pass" => $_SESSION["db_pass"],
        "port" => $_SESSION["db_port"],

        // Optional – wird nur eingetragen, wenn vorhanden
        "ws_supported" => $_SESSION["ws_supported"] ?? false,
    ];

    ConfigWriter::write($config);

} catch (Exception $e) {

    echo "<div class='panel'>
            <h3 style='color:#ff6b8a;'>Config Write Error</h3>
            <p>Could not write configuration file.</p>
            <pre style='background:#250030; padding:12px; border-radius:8px;'>{$e->getMessage()}</pre>

            <a class='btn-icon btn-red'
               href='index.php?step=settings&lang={$currentLang}'>
               <span class='icon'>◀</span> Return to Settings Step
            </a>
          </div>";

    return;
}

/* ============================================================
   INSTALLATION ENGINE (DB setup)
============================================================ */

try {
    $installer = new InstallerEngine(
        $_SESSION["db_host"],
        $_SESSION["db_user"],
        $_SESSION["db_pass"],
        $_SESSION["db_name"],
        $_SESSION["db_port"]
    );

    /* Run SQL structure + data */
    $installer->runMigrations();

    /* Create admin user */
    $installer->createAdmin(
        $_SESSION["admin_user"],
        $_SESSION["admin_email"],
        $_SESSION["admin_pass"]
    );

    /* Lock Installer (protect from rerun) */
    $installer->lockInstaller();

} catch (Throwable $e) {

    echo "<div class='panel'>
            <h3 style='color:#ff6b8a;'>Installation Failed</h3>
            <p>The installer could not complete the setup:</p>

            <pre style='background:#250030; padding:12px; border-radius:8px;'>
{$e->getMessage()}
            </pre>

            <a class='btn-icon btn-red'
               href='index.php?step=database&lang={$currentLang}'>
               <span class='icon'>◀</span> Return to Database Step
            </a>
          </div>";

    return;
}
?>

<!-- ============================================================
     SUCCESS PANEL
============================================================ -->
<div class="panel">
    <h3><?= $lang::get("install_complete") ?></h3>
    <p><?= $lang::get("you_can_now_login") ?></p>

    <div style="margin-top: 25px; display: flex; gap: 12px;">

        <a class="btn-icon btn-green"
           href="/dashboard?lang=<?= $currentLang ?>">
            <span class="icon">🚀</span>
            <?= $lang::get("launch_dashboard") ?>
        </a>

    </div>
</div>
