$(document).ready(function(){
    window.submitLike = function(url, like){
        // credits to
        // http://hdtuto.com/article/laravel-55-jquery-ajax-request-example-from-scratch
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: "POST",
            data: {
                like: like
            },
            success: function(response){
                $("#lblLikes").html(response.likes);
                $("#lblDislikes").html(response.dislikes);
                $("#btnLike").prop("disabled",response.like);
                $("#btnDislike").prop("disabled",!response.like);
            }
        });
    };
    $("#btnLike").click(function(){
        submitLike("{{ route('subject.like', compact('subject')) }}", 1);
    });
    $("#btnDislike").click(function(){
        submitLike("{{ route('subject.like', compact('subject')) }}", 0);
    });
});