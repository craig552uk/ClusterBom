<?php
/**
 * Footer displayed when logged in to the application
 *
 */
?>
<footer>
    <p>Logged in at <?php echo date(DATETIME_FORMAT, $session->time); ?></p>
</footer>
