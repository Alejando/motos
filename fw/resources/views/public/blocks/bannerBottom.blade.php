
<?php
$players = DwSetpoint\Models\Category::getPlayersTennis();
?>
<div id="owl-estrellas" class="owl-carousel owl-theme">
@foreach($players as $player)
	<div class="item">
    	<div class="cajaestrella margentop30">
		    <a href="{{url('categorias/deportistas/'.ucwords(str_replace(' ', '-', $player->name)))}}">
		    	<img src="{{ asset('/categoria/'.$player->id.'/estrella-265x265.png') }}" class="image-circle" style="width: 265px;" />
		    </a>
		    <h2>{{$player->name}}</h2>
		</div>
    </div>
@endforeach
</div>