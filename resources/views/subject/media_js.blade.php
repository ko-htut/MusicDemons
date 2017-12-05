function removeRow(button){
    $(button).parent().parent().parent().remove();
    return false;
}

$(document).ready(function(){
    $(".btn-create-medium").click(function(){
        $(`<div class="form-group row m-0">
               <div class="col-md-4 ml-xl-0 px-0">
                   <select class="form-control" name="medium_types[]">
                       @foreach($medium_types as $medium)
                           <option value="{{ $medium->id }}">{{ $medium->description }}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-md-8 mr-0 px-0">
                   <div class="input-group">
                       <input type="text" class="form-control" name="medium_values[]">
                       <button class="btn btn-warning" onclick="return removeRow(this)">
                           <i class="fa fa-trash"></i>
                       </button>
                   </div>
               </div>
           </div>`
        ).insertBefore($(this).closest(".medium-button-row"));
    });
});