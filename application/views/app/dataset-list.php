<?php
/**
 * Dataset list
 * Lists all datasets that are accessible to the user
 * Public and user-created datasets are listed seperately
 * 
 */
?>
<?php include('header.php'); ?>

<div id="content">
    <pre><?php 
        print_r($public_list);
        print_r($user_list);
    ?></pre>
</div>

<?php include('footer.php'); ?>
