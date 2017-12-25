<br class="d-none d-sm-inline">
<span class="float-none float-sm-right d-block d-sm-inline-block text-right">
    <form action="{{ route('like', compact('subject')) }}" method="POST" class="d-block d-sm-inline-block" {{ $subject->likes->find(Auth::user()->id) !== null ? "disabled" : "" }}>
        {{ csrf_field() }}
        <input type="hidden" name="like" value="1">
	      <button type="submit" class="btn btn-success btn-block d-sm-inline-block" {{ $subject->likes->find(Auth::user()->id) !== null ? "disabled" : "" }}>
    			  <i class="fa fa-thumbs-up"></i>
    			  {{ $subject->likes->count() }}
    	  </button>
    </form><!--
    --><form action="{{ route('like', compact('subject')) }}" method="POST" class="d-block d-sm-inline-block">
        {{ csrf_field() }}
        <input type="hidden" name="like" value="0">
    	  <button type="submit" class="btn btn-danger btn-block d-sm-inline-block" {{ $subject->dislikes->find(Auth::user()->id) !== null ? "disabled" : "" }}>
    			  <i class="fa fa-thumbs-down"></i>
    			  {{ $subject->dislikes->count() }}
    	  </button>
    </form>
</span>