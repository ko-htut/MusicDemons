function tryCollapseSidebar() {
  if($(window).width() < 767){
		var body = $('.app-body')[0];
    $(body).fixClass('sidebar-collapsed','');
    $('.navbar-toggler').fixClass('','open');
	}else{
		var body = $('.app-body')[0];
    $(body).fixClass('','sidebar-collapsed');
    $('.navbar-toggler').fixClass('open','');
	}
}

$(document).ready(function(){
    $(".sidebar, .content, .app-footer").addClass('no-transition');
    tryCollapseSidebar();
    $(".sidebar, .content, .app-footer").each(function(){
        $(this).offsetLeft;
    });
    //debugger;
    setTimeout(function() {
        $(".sidebar, .content, .app-footer").removeClass('no-transition');
    }, 500);
    
    // navbar
		$('.sidebar > nav > ul > li:has(ul) > span').each(function(){
			$(this).append("<span></span>");
		});
		$('.navbar-toggler').click(function(){
			$('.app-body').toggleClass('sidebar-collapsed');
      $(this).toggleClass('open');
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
		$(window).on('resize',function(){
			tryCollapseSidebar();
		});
});