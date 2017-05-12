<header class="header">

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{url('/')}}"><img src="{{	asset('img/KTMM_logo-ktm.svg')}}" id="iconMenu" alt="Menú"></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">

	        <li><a href="{{url('/')}}">INICIO</a></li>
			<li><a href="{{url('/nosotros')}}">NOSOTROS</a></li>
		    <li class="dropdown">
		        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MOTOS <span class="caret"></span>
		        <ul class="dropdown-menu">
		        	@foreach(\DwSetpoint\Models\Category::getChildrenBySlug('motos') as $subcategory)
                        <li><a href="{{url('/motos/'.$subcategory->name)}}">{{strtoupper($subcategory->name)}}</a></li>
                    @endforeach

		           {{--  <figure class="submenu_img ktm_visibility">
	            		<img src="img/motos/KTMM_destacados.jpg">
	            	</figure> --}}

		        </ul>
		    </li>
		    <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BOUTIQUE <span class="caret"></span>
		        <ul class="dropdown-menu">
		            @foreach(\DwSetpoint\Models\Category::getChildrenBySlug('boutique') as $subcategory)
                        <li><a href="">{{strtoupper($subcategory->name)}}</a></li>
                    @endforeach
		            {{-- <figure class="submenu_img ktm_visibility">
	            		<img src="img/motos/KTMM_destacados.jpg">
	            	</figure> --}}
		        </ul>
		    </li>
		    <li><a href="{{url('/servicio')}}">SERVICIO</a></li>
		    <li><a href="{{url('/noticias')}}">NOTICIAS</a></li>
		    <li><a href=""{{url('/contacto')}}>CONTACTO</a></li>
		     <li role="separator" class="divider"></li>
	      </ul>
	       <form class="navbar-form navbar-left  hidden-lg hidden-md " >
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Buscar..">
	        </div>
	      </form>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
</header>
