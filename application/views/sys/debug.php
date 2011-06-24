<?php if(DEBUG): ?>
<section id="debug">
    <fieldset>
    <legend>Debug Data</legend>
        
        <p>Data displayed in this section can be edited in the debug.php view 
           file. Debugging is enabled by a global variable set in the index.php
           file in the root directory.</p>
    
        <?php
            debug_block('Session Data', $_SESSION);
            debug_block('GET Data', $_GET);
            debug_block('POST Data', $_POST);
            debug_block('Cookie Data', $_COOKIE);
            debug_block('Server Data', $_SERVER);
        ?>
    
    </fieldset>
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
