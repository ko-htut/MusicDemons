// helper to ensure a class is added/removed
(function($) {

    $.fn.fixClass = function(addClass, removeClass){
        if(removeClass !== ""){
            if($(this).hasClass(removeClass)){
                $(this).removeClass(removeClass);
            }
        }
        if(addClass !== ""){
            if(!$(this).hasClass(addClass)){
                $(this).addClass(addClass);
            }
        }
    };

}(jQuery));