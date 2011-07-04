<?php
/**
 * Load spreadsheets asynchronously
 *
 */
?>

<ul>
<?php foreach($spreadsheets as $s): ?>
    <li>
        <div class="spreadsheet clearfix" data-uri="<?php echo urlencode(urlencode($s->uri)); ?>">
            <span class="title"><?php echo $s->title; ?></span> 
            <span class="author"><?php echo $s->author->name; ?></span>
            <span class="date"><?php echo $s->updated; ?></span>
        </div>
        <ul class="worksheets">
            <li class="loading">Loading Data...</li>
        </ul>
    </li>
    <!--<p><?php echo $s->uri; ?></p>
    <p><?php echo $s->updated; ?></p>
    <p><?php echo $s->author->name; ?></p>
    <p><?php echo $s->author->email; ?></p>-->
<?php endforeach; ?>
</ul>
<script type="text/javascript">
    $('.spreadsheet').click(function(){
        $(this).nextAll().slideToggle(); 
        var x = '<?php echo BASE_URL.'dataset/worksheets/'; ?>'+$(this).attr('data-uri');
        $(this).next().load(x);
    });
</script>
