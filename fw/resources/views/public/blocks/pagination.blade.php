
<div class= "motos_filter" ng-controller="PaginatorCtrl">
		<div class="col-xs-6 col-md-3">
			{{$paginator->total()}} resultados
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="form-group">
				<label  class="col-sm-6 control-label" for="per_page">Por página: </label>
				<div class="col-sm-6">
					<select class="form-control" id="per_page" ng-model="per_page" ng-change="changePagination()">		    <option value="6">6</option>
						<option value="12">12</option>
						<option value="18">18</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="form-group">
				<label  class="col-sm-4 control-label" for="order">Orden: </label>
				<div class="col-sm-8">
					<select class="form-control" id="order" ng-model="order" ng-change="changePagination()">
						<option value="asc" ="">Ascendente (Nombre)</option>
						<option value="desc" ="">Descendente (Nombre)</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			@if ($paginator->lastPage() > 1)
				<ul class="pagination">
					<li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
						<a href="{{ $paginator->url(1) }}@{{'&order='+order+'&per_page='+per_page}}"><<</a>
					</li>
					@for ($i = 1; $i <= $paginator->lastPage(); $i++)
						<li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
							<a href="{{ $paginator->url($i) }}@{{'&order='+order+'&per_page='+per_page}}">{{ $i }}</a>
						</li>
					@endfor
					<li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
						<a href="{{ $paginator->url($paginator->currentPage()+1) }}@{{'&order='+order+'&per_page='+per_page}}" >>></a>
					</li>
				</ul>
				<script type="text/javascript">
				var url="{{$paginator->url($paginator->currentPage())}}";
				</script>
			@endif
		</div>
</div>
