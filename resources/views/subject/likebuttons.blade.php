<br class="d-none d-sm-inline">
<span class="float-none float-sm-right d-block d-sm-inline-block text-right">
    <button id="btnLike" class="btn btn-success m-0 d-block d-sm-inline-block w-100 w-sm-auto" {{ (!Auth::check()) ? "disabled" : ($subject->likes->find(Auth::user()->id) !== null) ? "disabled" : "" }}>
			  <i class="fa fa-thumbs-up"></i>
			  <label id="lblLikes" class="p-0">{{ $subject->likes->count() }}</label>
	  </button><!--
    --><button id="btnDislike" class="btn btn-danger m-0 d-block d-sm-inline-block w-100 w-sm-auto" {{ (!Auth::check()) ? "disabled" : ($subject->dislikes->find(Auth::user()->id) !== null) ? "disabled" : "" }}>
			  <i class="fa fa-thumbs-down"></i>
			  <label id="lblDislikes" class="p-0">{{ $subject->dislikes->count() }}</label>
	  </button>
</span>