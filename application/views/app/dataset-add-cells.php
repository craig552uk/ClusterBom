<?php
/**
 * Asynchronously load data cells in a table
 */
?>

<div class="cells scroll frame">
    <table width="100%">
        <thead>
            <tr>
                <th class="side-col">&nbsp;</th>
                <?php for($c=1; $c<=$max_col; $c++): ?>
                    <th id="head-<?php echo $c; ?>"><?php echo $headings[$c]->label; ?></th>
                <?php endfor;?>
            </tr>
        </thead>
        <tbody>
            <?php for($r=1; $r<=$max_row; $r++): ?>
                <tr id="row-<?php echo $r; ?>" class="dr">
                    <td class="side-col">&nbsp;</td>
                    <?php for($c=1; $c<=$max_col; $c++): ?>
                        <?php $v = (isset($cells[$c][$r])) ? $cells[$c][$r] : '&nbsp;'; ?>
                        <td id="cell-<?php echo $c.'-'.$r; ?>"><?php echo $v; ?></td>
                    <?php endfor;?>
                </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.dr').click(function(){
        $(this).toggleClass('ex');
        var x='';
        $('.ex').each(function(){
            x += $(this).attr('id').split('-')[1] + '|';
        });
        $('#row-exclude').attr('value',x);
    });
</script>
