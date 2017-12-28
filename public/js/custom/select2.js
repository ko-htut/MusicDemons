$(document).ready(function(){
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
        
        // or you can follow the instructions at
        // https://select2.org/programmatic-control/add-select-clear-items#preselecting-options-in-an-remotely-sourced-ajax-select2
        
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