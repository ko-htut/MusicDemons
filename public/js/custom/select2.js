function parseItems(input) {
    //var regex = /(?<!\\)'/g;
    //var tekst = attr.replace(regex,"\"");
    const reverse_func = s => s.split('').reverse().join('');
    var reverse_regex = /'(?!\\)/g;
    var tekst = reverse_func(reverse_func(input).replace(reverse_regex,"\""));
    var tekst = tekst.replace(new RegExp("\\\\'","g"), "'");
    return JSON.parse(tekst);
}

function defined(input) {
    return (typeof input !== typeof undefined && input !== false);
}

$(document).ready(function(){
		$(".select2").each(function(){
        var a_url         = $(this).attr('data-url');
        var a_method      = $(this).attr('data-method');
        var a_placeholder = $(this).attr("data-placeholder");
        
        if(defined(a_url)) {
            if(!defined(a_method)) {
                a_method = 'get';
            }
        
    				var $selectbox = $(this).select2({
    						ajax: {
    								url: function(params){
                        if(a_method === 'get') {
        										return a_url + '/' + params.term;
                        } else {
                            return a_url;
                        }
    								},
    								data: function(params){
                        if(a_method === 'get') {
        										return {
                                
        										};
                        } else {
                            return {
                                search: params.term
                            };
                        }
    								},
    								dataType: 'json',
    								type: a_method,
    								processResults: function(data){
    										return {
    												results: data
    										};
    								}
    						},
    						minimumInputLength: 1,
    						placeholder: a_placeholder
    				});
            
            var attr = $(this).attr('data-selected');
            if(defined(attr)) {
                var items = parseItems(attr);
                $(items).each(function(){
                    var newOption = new Option(this.text, this.id, true, true);
                    $selectbox.append(newOption).trigger('change');
                });
            }
        } else {
            var $selectbox = $(this).select2({
                placeholder: a_placeholder,
                minimumResultsForSearch: -1
            });
            
            var a_items = $(this).attr('data-items');
            if(defined(a_items)) {
                var items = parseItems(a_items);
                $(items).each(function(){
                    var newOption = new Option(this.text, this.id, false, false);
                    $selectbox.append(newOption);
                });
            }
            
            var a_selected = $(this).attr('data-selected');
            if(defined(a_selected)) {
                var select = this;
                $("option:selected",$(select)).removeAttr("selected");
                $(parseItems(a_selected)).each(function(){
                    $("option[value=" + this.id + "]",$(select)).attr('selected',1);
                    //return false;
                });
            }
        }
        
        $(this).css('display','block');
    });
});