$(document).ready(function(){
    // navbar
		$('.sidebar > nav > ul > li:has(ul) > span').each(function(){
			$(this).append("<span></span>");
		});
		$('.navbar-toggler').click(function(){
  		if($("#app-body").hasClass("sidebar-hidden")) {
  			$("#app-body").removeClass("sidebar-hidden").addClass("sidebar-show");
        $("#navbar-toggler").removeClass("closed").addClass("open");
  		} else if($("#app-body").hasClass("sidebar-show")) {
  			$("#app-body").removeClass("sidebar-show").addClass("sidebar-hidden");
        $("#navbar-toggler").removeClass("open").addClass("closed");
  		} else if($("#app-body").hasClass("sidebar-auto")) {
  			if($(window).width() > 767) {
  				$("#app-body").removeClass("sidebar-auto").addClass("sidebar-hidden");
          $("#navbar-toggler").removeClass("auto").addClass("closed");
  			} else {
  				$("#app-body").removeClass("sidebar-auto").addClass("sidebar-show");
          $("#navbar-toggler").removeClass("auto").addClass("open");
  			}
  		}
      //$(this).toggleClass('open');
		});
		$('nav ul > li > span').click(function(){
			var nav = $(this).closest('nav');
			var was_open = $(this).hasClass('open');
			$('ul > li > span',$(nav)).removeClass('open');
			$('ul ul',$(nav)).slideUp();
			if(!was_open){
				$(this).addClass('open');
				$(this).next().slideDown();
			}
		});
});