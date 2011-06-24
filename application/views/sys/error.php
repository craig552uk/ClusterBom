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
	
<div id="error">
    <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
    <p><?php echo ( isset($message)) ? $message : ''; ?></p>
</div>
  
