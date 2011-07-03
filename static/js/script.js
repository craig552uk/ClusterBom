
$(document).ready(function(){

    /* Toggle fieldset boxes in debug section */
    $('#debug legend').click(function(){
        $(this).nextAll().toggle();
    });

    /* Toggle debug section with debug link */
    $('#debuglink').click(function(){
        $('#debug').toggle();
    });

    /* Load spreadsheets asynchronously on page */
    $.ajax({
        url : "http://local.craig-russell.co.uk/ClusterBom/dataset/spreadsheets/",
        cache: false,
        success : function(html){
            $('#ajax-spreadsheets').html(html);
        }
    });
    
    /* TODO Insert placeholder text in inputs for unsupported browsers */
});

/* 
 * Opens a popup window at provided url
 * Reloads the page when the window closes
 */
function popup(url) {
    newwindow=window.open(url,'name','height=500,width=450,top=200,left=200');
    if (window.focus) {newwindow.focus()}
    var timer = setInterval(function() { 
        if(newwindow.closed) {
            clearInterval(timer);
            window.location.reload();
        }
    }, 200);
}

