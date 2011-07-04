<?php
/**
 * Asynchronously load data cells in a table
 */
?>

<div class="cells hscroll frame">
    <table width="100%">
    
        <?php for($r=1; $r<$max_row; $r++): ?>
            <tr id="row-<?php echo $r; ?>">
            
                <?php for($c='A'; $c<$max_col; $c=$parent->nextCol($c)): ?>
                    <?php $v = (isset($cells[$c][$r])) ? $cells[$c][$r] : '&nbsp;'; ?>
                    <td id="cell-<?php echo $c.$r; ?>"><?php echo $v; ?></td>
                <?php endfor;?>
                
            </tr>
        <?php endfor;?>
        
    </table>
</div>
<script type="text/javascript">
    $('tr').click(function(){
        $(this).toggleClass('ex');
        var x='';
        $('.ex').each(function(){
            x+=$(this).attr('id')+'|';
        });
        $('#row-exclude').attr('value',x);
    });
</script>
