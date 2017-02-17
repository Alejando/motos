<header class="header">
	<figure class="ktm-header-logo">
		<img src="img/KTMM_logo-ktm.svg" alt="">
	</figure>
	<a id="menuMovilButton"  title="" class="ktm-header-menu"><i class="fa fa-bars fa-lg"></i></a>
	<nav class="ktm-header-nav" id="menuMovil">
		<ul class="ktm-header-ul">
			<li><a href="">INICIO</a></li>
			<li><a href="">NOSOTROS</a></li>
		    <li>
		        <a href="">MOTOS<i class="fa fa-caret-right fa-lg"></i></a>
		        <ul class="ktm-header-sub-ul">
		            <li><a href="">MOTOCROSS</a></li>
		            <li><a href="">ENDURO</a></li>
		            <li><a href="">FREERIDE</a></li>
		            <li><a href="">TRAVEL</a></li>
		            <li><a href="">NAKED</a></li>
		            <li><a href="">SUPERSPORT</a></li>
		            <li><a href="">SEMINUEVAS</a></li>
		        </ul>
		    </li>
		    <li>
		        <a href="">BOUTIQUE</a>
		        <ul class="ktm-header-sub-ul">
		            <li><a href="">POWERPARTS</a></li>
		            <li><a href="">POWERWEAR</a></li>
		        </ul>
		    </li>
		    <li><a href="">SERVICIO</a></li>
		    <li><a href="">NOTICIAS</a></li>
		    <li><a href="">CONTACTO</a></li>
		</ul>
	</nav>
</header>

@section('scripts')

	<script  type="text/javascript" >
		var menuMovil=false;
		var menuBike=false;
		var menuBoutique=false;
		//Función para mostrar y ocultar menu
		$( "#menuMovilButton" ).click(function() {
			console.log(menuMovil)
			if(menuMovil){
				 $('#menuMovil').slideUp();
				 menuMovil=false;
				 $('.fa-times').rotate({
					    angle : 0
				}).removeClass( "fa-times" ).addClass( "fa-bars" );
				
			}else{
				 menuMovil=true;
				 $('#menuMovil').slideDown( "slow", function() {
				  });
				 $('.fa-bars').rotate({
					    angle : 90
				}).removeClass( "fa-bars" ).addClass( "fa-times" );
			}
		});
		//Función para mostrar y ocultar menu BIKES
		$( "#menuMotos" ).click(function() {
			if(menuMotos){
				 $('#subMenuMotos').slideUp();
				 menuMotos=false;
				 $('#menuMotos p').rotate({
				    angle : 0
				});	
			}else{
				menuMotos=true;
				$('#subMenuMotos').slideDown( "slow", function() {
				  });
				$('#menuMotos p').rotate({
				    angle : 90
				});
			}
		});
		//Función para mostrar y ocultar menu BOUTIQUE
		$( "#menuBoutique" ).click(function() {
			if(menuBoutique){
				 $('#subMenuBoutique').slideUp();
				 menuBoutique=false;
				$('#menuBoutique p').rotate({
				    angle : 0
				});	
			}else{
				menuBoutique=true;
				$('#subMenuBoutique').slideDown( "slow", function() {
				 });
				$('#menuBoutique p').rotate({
					    angle : 90
				});
			}
		});
		$( "#menuBikesWeb" ).mouseover(function() {
			$('#subMenuBikesWeb').slideDown('fast');
		});		
		$("#menuBikesWeb").mouseleave(function () {
			$('#subMenuBikesWeb').slideUp('fast');
		});
		$( "#menuBoutiqueWeb" ).mouseover(function() {
			$('#subMenuBoutiqueWeb').slideDown('fast');
		});		
		$("#menuBoutiqueWeb").mouseleave(function () {
			$('#subMenuBoutiqueWeb').slideUp('fast');
		});

	</script>
@endsection