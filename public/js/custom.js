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

// check-all button
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
    $(".sidebar-nav, .content, .app-footer").addClass('no-transition');
    tryCollapseSidebar();
    $(".sidebar-nav, .content, .app-footer").each(function(){
        $(this).offsetLeft;
    });
    //debugger;
    setTimeout(function() {
        $(".sidebar-nav, .content, .app-footer").removeClass('no-transition');
    }, 500);
    //$(".sidebar-nav, .content, .app-footer").removeClass('no-transition');
    
    // navbar
		$('.sidebar-nav > nav > ul > li:has(ul) > span').each(function(){
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
   
    // checkbuttons
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
    
    
    // make table rows clickable
		$('table > tbody > tr[data-url]').on('click',function(){
				if($(this).attr('data-url') != null){
					window.location.href = $(this).attr('data-url');
				}
		});
		
		// apply Select2 library
    //
    // Follow the instructions at
    // https://laravelcollective.com/docs/5.2/html
		$(".select2").each(function(){
				var $selectbox = $(this).select2({
						ajax: {
								url: function(params){
										return $(this).attr('data-url') + '/' + params.term;
								},
								data: function(term){
										return {
										};
								},
								dataType: 'json',
								type: 'get',
								processResults: function(data){
										return {
												results: data
										};
								}
						},
						minimumInputLength: 1,
						placeholder: $(this).attr("data-placeholder")
				});
        
        var attr = $(this).attr('data-selected');
        if(typeof attr !== typeof undefined && attr !== false) {
            
            // sadly browsers other than Chrome/Opera don't support positive/negative lookbehinds
            // which is a real shame
            // credits to JBE
            // https://www.versti.eu/TranslateProxy/https/stackoverflow.com/questions/641407/javascript-negative-lookbehind-equivalent/11347100#11347100
            
            // this is the regex I wanted to run: match single-quote, not preceded by backslash
            //var regex = /(?<!\\)'/g;
            //var tekst = attr.replace(regex,"\"");
            
            // declare inline reverse function
            const reverse_func = s => s.split('').reverse().join('');
            // declare reversed regex (match single-quote, not followed by backslash)
            var reverse_regex = /'(?!\\)/g;
            
            // reverse the input, replace the non-escaped single-quotes by double-quotes, finally reverse again
            var tekst = reverse_func(reverse_func(attr).replace(reverse_regex,"\""));
            
            // replace escaped single-quotes by normal single-quotes
            var tekst = tekst.replace(new RegExp("\\\\'","g"), "'");
            var items = JSON.parse(tekst);
            $(items).each(function(){
                var newOption = new Option(this.text, this.id, true, true);
                $selectbox.append(newOption).trigger('change');
            });
            
            // now this example is cross-browser !!!
        }
        
        $(this).css('display','block');
    });
});