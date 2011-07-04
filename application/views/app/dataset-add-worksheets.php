<?php
/**
 * Load worksheets asynchronously
 *
 */
?>

<?php foreach($worksheets as $w): ?>
    <li class="worksheet clearfix" 
        data-uri="<?php echo $w->uri; ?>"
        onclick="$('.worksheet-selected').removeClass('worksheet-selected'); $(this).addClass('worksheet-selected'); var uri = $(this).attr('data-uri'); $('#worksheet-uri').attr('value', uri);"
        >
        <span class="title"><?php echo $w->title; ?></span>
    </li>
<?php endforeach; ?>
