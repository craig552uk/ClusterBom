
$(document).ready(function(){

    /* Toggle fieldset boxes in debug section */
    $('#debug legend').click(function(){
        $(this).nextAll().slideToggle();
    });

    /* Toggle debug section with debug link */
    $('#debuglink').click(function(){
        $('#debug').slideToggle();
    });

    /* Set content to max window height on load and resize*/
    $(window).resize(function(){resizeContent()});
    resizeContent();

});

/* Set content to max window height */
function resizeContent(){
    var h = $(window).height() - 130;
    if(h>500){
        $('.content').height(h);
    }
}

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

