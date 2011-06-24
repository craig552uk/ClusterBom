<?php
/**
 * Main View 
 *
 * This is the view for error messages
 *
 */
?>
	
<div id="error">
    <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
    <p><?php echo ( isset($message)) ? $message : ''; ?></p>
</div>
  
