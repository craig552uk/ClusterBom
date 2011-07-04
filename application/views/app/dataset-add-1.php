<?php
/**
 * Add a data set view
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="prog">
    <ul class="hlist">
        <li id="current"><span>1</span>Choose Worksheet</li>
        <li><span>2</span>Exclude Rows</li>
        <li><span>3</span>Configure Headings</li>
        <li><span>4</span>Import Data</li>
    </ul>
</div>

<div class="app">
    <section>
        <h1>Choose Worksheet</h1>
        <?php if(!$hastokens): ?>
            <div class="frame">
                <p>ClusterBom can import data from spreadsheets in your Google Docs account.</p>
                <p><a id="goog_auth" class="button" onclick="popup('<?php echo BASE_URL.'auth/oauth2/'; ?>'); return false;">Login to Google</a></p>
            </div>
        <?php else: ?>
            <div id="ajax-spreadsheets" class="spreadsheets hscroll frame">
                <p>Loading Data...</p>
                <script type="text/javascript">
                    /* Load spreadsheets asynchronously on page load */
                    $('#ajax-spreadsheets').load('<?php echo BASE_URL.'dataset/spreadsheets/'; ?>');
                </script>
            </div>

            <form method="post" action="">
                <input type="hidden" name="worksheet-uri" id="worksheet-uri" value=""/>
                <input type="hidden" name="import-step" id="import-step" value="2"/>
                <div><input type="submit" name="submit" id="submit" value="Continue" />
                   <a class="cancel" href="<?php echo BASE_URL; ?>">Cancel</a></div>
            </form>
        <?php endif; ?>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
