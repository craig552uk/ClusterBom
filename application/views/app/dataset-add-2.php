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
        <li id="current"><span>2</span>Configure Headings</li>
        <li><span>3</span>Exclude Rows</li>
        <li><span>4</span>Import Data</li>
    </ul>
</div>

<div class="app">
    <section>
        <h1>Configure Headings</h1>
        <p>Set headings for each field. Click a data row to use the values in the row as field headings.</p>
        <p>Also, define data types for the fields.</p>
        <dl>
            <dt>Identifier</dt><dd>The column is an idenfier for the record</dd>
            <dt>Numeric</dt><dd>The column holds numeric data</dd>
            <dt>Categorical</dt><dd>The column holds categorical labels</dd>
        </dl>
        <form method="post" action="">
        
            <div id="ajax-cells">
                <div class="frame">
                    <p>Loading Data...</p>
                </div>
            </div>
            <script type="text/javascript">
                $('#ajax-cells').load('<?php echo BASE_URL.'dataset/headings/'.urlencode(urlencode($worksheet_uri)); ?>');
            </script>
        
            <input type="hidden" name="import-step" id="import-step" value="3"/>
            <input type="hidden" name="worksheet-uri" id="worksheet-uri" value="<?php echo $worksheet_uri; ?>"/>
            <div><input type="submit" name="submit" id="submit" value="Continue" />
               <a class="cancel" href="<?php echo BASE_URL; ?>">Cancel</a></div>
        </form>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
