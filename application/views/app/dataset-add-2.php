<?php
/**
 * Add a data set view
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="prog">
    <ul class="hlist">
        <li><span>1</span>Choose Worksheet</li>
        <li id="current"><span>2</span>Exclude Rows</li>
        <li><span>3</span>Configure Headings</li>
        <li><span>4</span>Import Data</li>
    </ul>
</div>

<div class="app">
    <section>
        <h1>Exclude Rows</h1>
        <div id="ajax-cells">
            <div class="frame">
                <p>Loading Data...</p>
            </div>
        </div>
        <script type="text/javascript">
            $('#ajax-cells').load('<?php echo BASE_URL.'dataset/cells/'.urlencode(urlencode($worksheet_uri)); ?>');
        </script>
        <form method="post" action="">
            <input type="hidden" name="import-step" id="import-step" value="3"/>
            <div><input type="submit" name="submit" id="submit" value="Continue" />
               <a class="cancel" href="<?php echo BASE_URL; ?>">Cancel</a></div>
        </form>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
