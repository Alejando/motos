<!--div class="banner">
    <img src="{{asset('img/agassi.png')}}">
    <div>Andre Agassi</div>
</div-->


<?php
$players = DwSetpoint\Models\Category::getPlayersTennis();
?>
<style type="text/css">
.image-circle{
    border-radius: 50%;
    width: 265px;
    height: 265px;
    border: 3px solid #FFF;
    margin: 10px;
    border-style: dotted;
}
</style>
<div id="owl-estrellas" class="owl-carousel owl-theme">
@foreach($players as $player)
	<div class="item">
    	<div class="cajaestrella margentop30">
		    <a href="{{url('categorias/deportistas/'.ucwords(str_replace(' ', '-', $player->name)))}}">
		    	<img src="{{ asset('/categoria/'.$player->id.'/estrella-265x265.png') }}" class="image-circle"/>
		    </a>
		    <h2>{{$player->name}}</h2>
		</div>
    </div>
@endforeach

</div>