
<?php
$players = DwSetpoint\Models\Category::getPlayersTennis();
?>
<div id="owl-estrellas" class="owl-carousel owl-theme">
@foreach($players as $player)
	<div class="item">
    	<div class="cajaestrella margentop30">
            <a href="{!!$player->getURL()!!}">
		    	<img src="{{ route('estrella.getImage',[
                            'name' => str_slug($player->name), 
                            'id' => $player->id, 
                            'width' => 265, 
                            'height'=>265]
                        )}}" class="image-circle" style="width: 265px;" alt="{{$player->name}}" />
		    </a>
		    <h2>{{$player->name}}</h2>
		</div>
    </div>
@endforeach
</div>