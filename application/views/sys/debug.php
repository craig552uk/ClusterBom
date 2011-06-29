<?php if(DEBUG): ?>
<section id="debug">
        <?php
            debug_block('Session Data', $_SESSION);
            debug_block('GET Data', $_GET);
            debug_block('POST Data', $_POST);
            debug_block('Cookie Data', $_COOKIE);
            debug_block('Server Data', $_SERVER);
            global $url_processing;
            debug_block('URL Processing', $url_processing);
        ?>
</section>
<?php endif; ?>
<?php

    /*
     * Displays the contents of a data array in an HMTL fieldset
     *
     * @param string $legend The legend of the field set
     * @param mixed  $data   The data to be displayed
     */
    function debug_block($legend, $data){
        echo "<fieldset><legend>$legend</legend><pre>";
        print_r($data);
        echo "</pre></fieldset>";
    }

?>
