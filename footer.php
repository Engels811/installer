<?php
/* ============================================================
   WONDERLIFE MEGA SYSTEM INSTALLER — FOOTER CORE (FINAL v3)
   NeonUX Center 3-Line Block — Zero header-output issues
============================================================ */
?>
        </div> <!-- installer-content -->


        <!-- ============================================================
             INSTALLER FOOTER (NEONUX v3 – CENTER BLOCK)
        ============================================================ -->
        <footer class="wln-footer">
            <div><?= "Entwickler :<br>Chriss Engels" ?></div>
            <!-- LEFT PLACEHOLDER (frei für später: Version, Icon, etc.) -->
            <div class="footer-space"></div>

            <!-- CENTERED TEXT BLOCK -->
            <div class="footer-center-block">
                <div><?= t("footer_part_of") ?></div>
                <div><?= t("footer_powered") ?></div>
                <div><?= t("footer_dev") ?> • <?= t("footer_engine") ?></div>
            </div>

            <!-- RIGHT PLACEHOLDER -->
            <div class="footer-space"></div>

        </footer>

</div> <!-- installer-wrapper -->

<?php
/* ============================================================
   Output Buffer beenden – verhindert "headers already sent"
============================================================ */
if (function_exists('ob_end_flush')) {
    @ob_end_flush();
}
?>

</body>
</html>
