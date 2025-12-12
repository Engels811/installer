<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

/* Ensure completed_steps array exists */
if (!isset($_SESSION['completed_steps']) || !is_array($_SESSION['completed_steps'])) {
    $_SESSION['completed_steps'] = [];
}

/* ------------------------------------------------------------
   PATH CONSTANTS
------------------------------------------------------------ */
define("INSTALL_PATH", __DIR__);
define("CORE_PATH", INSTALL_PATH . "/core");
define("STEP_PATH", INSTALL_PATH . "/steps");
define("TRANSLATION_PATH", INSTALL_PATH . "/translations");

/* ------------------------------------------------------------
   AUTOLOADER
------------------------------------------------------------ */
spl_autoload_register(function($class) {
    $file = CORE_PATH . "/" . $class . ".php";
    if (file_exists($file)) require_once $file;
});

/* ------------------------------------------------------------
   LANGUAGE HANDLING
------------------------------------------------------------ */
$lang = $_GET["lang"] ?? $_SESSION["installer_lang"] ?? "de";
$_SESSION["installer_lang"] = $lang;

/* Always load German base file */
$translations = require TRANSLATION_PATH . "/de.php";

/* ------------------------------------------------------------
   STEP HANDLING
------------------------------------------------------------ */
$steps = StepManager::all();
$step  = $_GET["step"] ?? "boot";

/* Step must exist */
if (!in_array($step, $steps)) {
    $step = "boot";
}

/* Numeric index */
$currentIndex = StepManager::index($step);

/* Auto-complete BOOT (step0) */
if ($step === "boot") {
    StepManager::complete("boot");
}

/* Progress bar */
$progressPercent = StepManager::progress($currentIndex);

/* ------------------------------------------------------------
   GLOBAL INSTALL CONTEXT
------------------------------------------------------------ */
$GLOBALS["_GLOBAL_INSTALL"] = [
    "lang"            => $lang,
    "translations"    => $translations,
    "step"            => $step,
    "steps"           => $steps,
    "currentIndex"    => $currentIndex,
    "progressPercent" => $progressPercent
];

/* ------------------------------------------------------------
   LOAD LAYOUT AND STEP
------------------------------------------------------------ */
require INSTALL_PATH . "/header.php";

/* step file name = step{index}_{name}.php */
$stepFile = STEP_PATH . "/step{$currentIndex}_{$step}.php";

if (file_exists($stepFile)) {
    require $stepFile;
} else {
    echo "<div class='panel'><h3>Missing Step File:</h3><p>{$stepFile}</p></div>";
}

require INSTALL_PATH . "/footer.php";
