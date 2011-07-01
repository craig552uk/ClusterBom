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
        <li><span>4</span>Import</li>
    </ul>
</div>

<div class="app">
    <section>
        <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
        
        <?php if(!$hastokens): /* Request login */ ?>
            <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/oauth2/' ?>'); return false;">Get Spreadsheets</a></p>
        <?php else: /* Display Spreadsheets */ ?>
            <!--<pre>
            <?php print_r($spreadsheets); ?>
            </pre>-->
            <ul class="spreadsheets">
            <?php foreach($spreadsheets as $s): ?>
                <li>
                    <p><?php echo $s->title; ?></p>
                    <p><?php echo $s->uri; ?></p>
                    <p><?php echo date(DATETIME_FORMAT, $s->updated); ?></p>
                    <p><?php echo $s->author->name; ?></p>
                    <p><?php echo $s->author->email; ?></p>
                    
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
