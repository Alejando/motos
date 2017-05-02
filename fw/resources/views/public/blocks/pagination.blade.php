@if ($paginator->lastPage() > 1)
	<ul class="pagination">
	    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
	        <a href="{{ $paginator->url(1) }} @{{'&order='+order+'&per_page='+per_page}}"><<</a>
	    </li>
	    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
	        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
	            <a href="{{ $paginator->url($i) }} @{{'&order='+order+'&per_page='+per_page}}">{{ $i }}</a>
	        </li>
	    @endfor
	    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
	        <a href="{{ $paginator->url($paginator->currentPage()+1) }} @{{'&order='+order+'&per_page='+per_page}}" >>></a>
	    </li>
	</ul>
	<script type="text/javascript">
		var url="{{$paginator->url($paginator->currentPage())}}";
	</script>
@endif