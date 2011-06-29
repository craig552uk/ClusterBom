<?php
/**
 * Add a data set view
 *
 */
?>
<?php include('header.php'); ?>

<nav id="content-nav">
    <ul class="hlist">
        <li><a href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a id="selected" href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualization' ?>">Visualizations</a></li>
    </ul>
</nav><!-- #content-nav -->

<div class="content progress">
    <ul class="hlist">
    <li id="current"><span>1</span>Choose Worksheet</li>
        <li><span>2</span>Exclude Rows</li>
        <li><span>3</span>Configure Headings</li>
        <li><span>4</span>Import</li>
    </ul>
    <section>
        <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
        
        <?php if($hastokens): /* Display Spreadsheets */ ?>
            <p>List of Spreadsheets</p>
        <?php else: ?>
            <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/oauth2/' ?>'); return false;">Get Spreadsheets</a></p>
        <?php endif; ?>
    </section>
</div><!-- .content -->

<?php include('footer.php'); ?>
