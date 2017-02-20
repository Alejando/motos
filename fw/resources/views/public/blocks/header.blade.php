<header class="header">
	<figure class="header_logo">
		<img src="img/KTMM_logo-ktm.svg" alt="">
	</figure>
	<a id="menuMovilButton"  title="" class="header_menu">
		<figure class="icon_menu">
			<img src="img/svg/menu.svg" id="iconMenu" alt="Menú">	
		</figure>
	</a>
	<nav class="header_nav" id="menuMovil">
		<ul class="header_ul">
			<li><a href="">INICIO</a></li>
			<li><a href="">NOSOTROS</a></li>
		    <li id="menuMotosWeb">
		        <a  id="menuMotos" >MOTOS<i class="fa fa-caret-right icon_caret"></i></a>
	        	<ul id="subMenuMotos" class="header_sub_ul">
		            <li><a href="">MOTOCROSS</a></li>
		            <li><a href="">ENDURO</a></li>
		            <li><a href="">FREERIDE</a></li>
		            <li><a href="">TRAVEL</a></li>
		            <li><a href="">NAKED</a></li>
		            <li><a href="">SUPERSPORT</a></li>
		            <li><a href="">SEMINUEVAS</a></li>
		            <figure class="submenu_img hide">
	            		<img src="img/motos/KTMM_destacados.jpg">
	            	</figure>
		        </ul> 
		    </li>
		    <li id="menuBoutiqueWeb">
		        <a id="menuBoutique" >BOUTIQUE<i class="fa fa-caret-right icon_caret"></i></a>
		        <ul id="subMenuBoutique" class="header_sub_ul">
		            <li><a href="">POWERPARTS</a></li>
		            <li><a href="">POWERWEAR</a></li>
		            <figure class="submenu_img hide">
	            		<img src="img/motos/KTMM_destacados.jpg">
	            	</figure>
		        </ul>
		    </li>
		    <li><a href="">SERVICIO</a></li>
		    <li><a href="">NOTICIAS</a></li>
		    <li><a href="">CONTACTO</a></li>
		    <li class="li_separator" ></li>
		    <li  class="li_search">
				<div class="div_search">
					<input type="search" name="" value="" id="menuSearch"  placeholder="Buscar...">
				
				</div>
				<a href="" class="link_search"><i class="fa fa-search"></i></a>
		    </li>
		</ul>
	</nav>
</header>

@section('scripts')

	<script  type="text/javascript" >
		var menuMovil=false;
		var menuBike=false;
		var menuBoutique=false;
		//Función para mostrar y ocultar menu
		if($(window).width()<950){
			$( "#menuMovilButton" ).click(function() {
				if(menuMovil){
					 $('#menuMovil').slideUp();
					 menuMovil=false;
					 $('#iconMenu').attr("src","img/svg/menu.svg")
					
				}else{
					closeAllSubMenus()
					 menuMovil=true;
					 $('#menuMovil').slideDown( "slow", function() {
					  });
					 $('#iconMenu').attr("src","img/svg/close.svg")
				}
			});
			//Función para mostrar y ocultar menu Motos
			$( "#menuMotos" ).click(function() {
				if(menuMotos){
					 $('#subMenuMotos').slideUp();
					 menuMotos=false;
					 $('#menuMotos i').removeClass( "fa-caret-down" ).addClass( "fa-caret-right" );
				}else{
					closeAllSubMenus();
					menuMotos=true;
					$('#subMenuMotos').slideDown( "slow", function() {
					  });
					$('#menuMotos i').removeClass( "fa-caret-right" ).addClass( "fa-caret-down" );
				}
			});
			//Función para mostrar y ocultar menu BOUTIQUE
			$( "#menuBoutique" ).click(function() {
				if(menuBoutique){
					 $('#subMenuBoutique').slideUp();
					 menuBoutique=false;
					$('#menuBoutique i').removeClass( "fa-caret-down" ).addClass( "fa-caret-right" );
				}else{
					closeAllSubMenus();
					menuBoutique=true;
					$('#subMenuBoutique').slideDown( "slow", function() {
					 });
					$('#menuBoutique i').removeClass( "fa-caret-right" ).addClass( "fa-caret-down" );
				}
			});
		}
		else{
			$('.submenu_img').removeClass('hide');
			$( "#menuMotosWeb" ).mouseover(function() {
				$('#subMenuMotos').slideDown('fast');
			});		
			$("#menuMotosWeb").mouseleave(function () {
				$('#subMenuMotos').slideUp('fast');
			});
			$( "#menuBoutiqueWeb" ).mouseover(function() {
				$('#subMenuBoutique').slideDown('fast');
			});		
			$("#menuBoutiqueWeb").mouseleave(function () {
				$('#subMenuBoutique').slideUp('fast');
			});
		}
		
		
		function closeAllSubMenus() {
			$('.header_sub_ul').slideUp( "slow");
			$('.icon_caret').removeClass( "fa-caret-down" ).addClass( "fa-caret-right" );
			menuBoutique=false;
			menuMotos=false;
		}

	</script>
@endsection