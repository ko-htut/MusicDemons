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

$(document).ready(function(){
	  $(".check-btn").click(function(event){
			var sender = event.currentTarget;
			var input = $("+input",$(sender));
			var name = $(sender).next().attr('name').slice(0,-2);
			
      // toggle the input's value
      if($(input).is(':checked')) {
        $(input).prop("checked", false);
        $(sender).fixClass('btn-secondary','btn-primary');
      } else {
        $(input).prop("checked", true);
        $(sender).fixClass('btn-primary','btn-secondary');
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
});