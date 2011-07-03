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
            <div class="spreadsheets">
                <p>ClusterBom can import data from Google Docs.</p>
                <p><a href="#" onclick="popup('<?php echo BASE_URL.'auth/oauth2/'; ?>'); return false;">Login to Google</a></p>
            </div>
        <?php else: ?>
            <div id="ajax-spreadsheets" class="spreadsheets">
                <p>Loading Data...</p>
                <script type="text/javascript">
                    /* Load spreadsheets asynchronously on page load */
                    $('#ajax-spreadsheets').load('<?php echo BASE_URL.'dataset/spreadsheets/'; ?>');
                </script>
            </div>

            <form>
                <input type="hidden" name="spreadsheet" id="spreadsheet" value=""/>
                <input type="hidden" name="worksheet" id="worksheet" value=""/>
                <div><input type="submit" name="submit" id="submit" value="Continue" />
                   <a class="cancel" href="<?php echo BASE_URL; ?>">Cancel</a></div>
            </form>
        <?php endif; ?>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
