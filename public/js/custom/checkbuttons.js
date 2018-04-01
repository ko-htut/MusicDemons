// check-all button
function applyCheckAllButtons(name) {
      debugger;
      // toggle All button
      var all_button = $(".check-all-btn[data-name='" + name + "']");
      var all_inputs = $("input[name='" + name + "[]']");
      // all checked?
      var checked_inputs = $.grep(all_inputs,function(item,index){
        return $(item).is(":checked");
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
        $(input).removeAttr("checked");
        $(sender).fixClass('btn-secondary','btn-primary');
      } else {
        $(input).attr("checked","");
        $(sender).fixClass('btn-primary','btn-secondary');
      }
      applyCheckAllButtons(name);
		});
		$(".check-all-btn").click(function(event){
			var sender = event.currentTarget;
			var name = $(sender).attr("data-name");
			var new_value = $(sender).toggleClass('btn-primary btn-secondary').hasClass("btn-primary");
      
			$("input[name='" + name + "[]']").each(function(){
        if(new_value) {
          $(this).attr("checked","checked");
          $(this).prev().fixClass('btn-primary','btn-secondary')
  			} else {
          $(this).removeAttr("checked");
          $(this).prev().fixClass('btn-secondary','btn-primary')
  			}
			});
		});
    $(".check-all-btn").each(function(){
      applyCheckAllButtons($(this).attr('data-name'));
    });
});