<?php
/**
 * Main View 
 *
 * This is the default view
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
?>
<?php include('header.php'); ?>
	
    <div id="error">
        <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
    </div>
  
<?php include('footer.php'); ?>
