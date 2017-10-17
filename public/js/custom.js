(function($) {

    $.fn.fixClass = function(addClass, removeClass){
        if($(this).hasClass(removeClass)){
            $(this).removeClass(removeClass);
        }
        if(!$(this).hasClass(addClass)){
            $(this).addClass(addClass);
        }
    };

}(jQuery));

function applyCheckAllButtons(name) {
      // toggle All button
      var all_button = $(".check-all-btn[data-name='" + name + "']");
      var all_inputs = $("input[name='" + name + "[]']");
      // all checked?
      var checked_inputs = $.grep(all_inputs,function(item,index){
        return($(item).val() !== '');
      });
      // apply the style
      if(checked_inputs.length === all_inputs.length) {
        $(all_button).fixClass('btn-primary','btn-secondary')
			} else {
        $(all_button).fixClass('btn-secondary','btn-primary')
			}
}

$(document).ready(function(){
		$('.sidebar-nav > nav > ul > li:has(ul) > span').each(function(){
			$(this).append("<span></span>");
		});
		
		$('.navbar-toggler').click(function(){
			$('.app-body').toggleClass('sidebar-collapsed');
		});
	  $(".check-btn").click(function(event){
			var sender = event.currentTarget;
			var input = $("+input",$(sender));
			var name = $(sender).next().attr('name').slice(0,-2);
			
      // toggle the input's value
      if($(input).val() === '') {
        $(input).val($(input).attr('data-value'));
        $(sender).fixClass('btn-primary','btn-secondary');
      } else {
        $(input).val('');
        $(sender).fixClass('btn-secondary','btn-primary');
      }
      
      applyCheckAllButtons(name);
		});
		$(".check-all-btn").click(function(event){
			var sender = event.currentTarget;
			var name = $(sender).attr("data-name");
			var new_value = $(sender).toggleClass('btn-primary btn-secondary').hasClass("btn-primary");
      
			$("input[name='" + name + "[]']").each(function(){
				$(this).val(new_value ? $(this).attr('data-value') : '');
        if(new_value) {
          $(this).prev().fixClass('btn-primary','btn-secondary')
  			} else {
          $(this).prev().fixClass('btn-secondary','btn-primary')
  			}
			});
		});
    $(".check-all-btn").each(function(){
      applyCheckAllButtons($(this).attr('data-name'));
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
			if($(window).width() < 767){
				var body = $('.app-body')[0];    
				if(!$(body).hasClass('sidebar-collapsed')){
					$(body).addClass('sidebar-collapsed');
				}
			}else{
				var body = $('.app-body')[0];    
				if($(body).hasClass('sidebar-collapsed')){
					$(body).removeClass('sidebar-collapsed');
				}
			}
		});
		$('table > tbody > tr[data-url]').on('click',function(){
			if($(this).attr('data-url') != null){
				window.location.href = $(this).attr('data-url');
			}
		});
});