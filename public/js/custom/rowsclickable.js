$(document).ready(function(){
    // make table rows clickable
		$('table > tbody > tr[data-url]').on('click',function(){
				if($(this).attr('data-url') != null){
					window.location.href = $(this).attr('data-url');
				}
		});
});