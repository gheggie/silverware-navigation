$(function(){
    
    // Initialise Menus:
    
    $('#$ListID').smartmenus({
        showTimeout: $ShowTimeout,
        hideTimeout: $HideTimeout,
        showOnClick: $ShowOnClick,
        showDuration: $ShowDuration,
        hideDuration: $HideDuration,
        showFunction: $ShowFunction,
        hideFunction: $HideFunction
    });
    
    // Setup Menu Toggle Button:
    
    $('#$HTMLID div.menu > .bar > button').click(function(e){
        e.preventDefault();
        $('#$HTMLID div.menu > .nav').slideToggle();
        $(this).toggleClass('is-active');
    });
    
    // Show Menu Following Resize:
    
    $(window).resize(function(){
        if ($(window).width() > 750 && $('#$HTMLID div.menu > .nav').is(':hidden')) {
            $('#$HTMLID div.menu > .nav').removeAttr('style');
        }
    });
    
});
