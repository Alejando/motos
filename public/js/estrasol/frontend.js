var pathArray = location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var url = protocol + '//' + host + '/' + 'glimglam';


$(document).ready(function(){
	/* Funcionalidad scroll btn subir */
	$(window).scroll(function(){
		var top = $(window).scrollTop();
		if(top > 150){
			$('.subir').addClass('subir-activo');
		}else{
			$('.subir').removeClass('subir-activo');
		}
	});

	var scrollAnimation = false;
	$('.subir').click(function(){
		scrollTop();
		return false;
	});

	function scrollTop(){
		scrollAnimation = true;
		$('body,html').animate({scrollTop : 0}, 500, function(){
			scrollAnimation = false;
		});
		return false;
	}

	/* Funcionalidad general para menu */

	$('.link-menu, .cerrar-menu').click(function(e){
		e.preventDefault();
		$('.link-menu').toggleClass("menu-activo");
		$('.menu-principal').toggleClass('menu-activo');
		$('body').toggleClass('no-scroll');
	});

	/* Termina funcionalidad general para menu */

	/* Funcionalidad de contador */
	setInterval(function(){
		$('.countdown').each(function(){
			var exp = $(this).attr('expiration');
			var rest = timer(exp);
			htmlTime = '';
			if(rest.tipo){
				if(rest.dd > 1){
					htmlTime += rest.dd+' días '+rest.hh+':'+rest.mm+':'+rest.ss;
				}else if(rest.dd == 1){
					htmlTime += rest.dd+' día '+rest.hh+':'+rest.mm+':'+rest.ss;
				}else if(rest.hh > 1){
					htmlTime += rest.hh+':'+rest.mm+':'+rest.ss+' horas';
				}else if(rest.hh == 1){
					htmlTime += rest.hh+' hora '+rest.mm+':'+rest.ss;
				}else if(rest.mm > 1){
					htmlTime += rest.mm+':'+rest.ss+' minutos';
				}else if(rest.mm == 1){
					htmlTime += rest.mm+':'+rest.ss+' minuto';
				}else if(rest.ss > 0){
					htmlTime += rest.mm+':'+rest.ss+' segundos';
				}else{
					htmlTime += 'subasta iniciada';
				}
			}else{
				htmlTime += 'subasta iniciada';
			}

			$(this).html(htmlTime);
		});
	},1000);

	function timer(exp) {//La fecha de termino tiene que estar asi 2011-04-11T11:51:00
		exp = new Date(exp);
		var diff = exp - new Date(get_date_time());
		if(diff > 0){
			diff = (Math.round(diff/1000));

			var seconds = diff % 60;

			var minutes = Math.floor(diff / 60);
			var hours = Math.floor(minutes / 60);
			var days = Math.floor(hours / 24);
			minutes %= 60;
			hours %= 24;
			
			seconds = ("0" + seconds).slice(-2);
			minutes = ("0" + minutes).slice(-2);
			hours = ("0" + hours).slice(-2);

			var remaining = {"tipo":1,"dd":days,"hh":hours,"mm":minutes,"ss":seconds};
		}else{
			var remaining = {"tipo":0};
		}

		//console.log(remaining);
		return remaining;
	}

	function get_date_time() {
		now = new Date();
		year = "" + now.getFullYear();
		month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
		day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
		hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
		minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
		second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
		return year + "-" + month + "-" + day + "T" + hour + ":" + minute + ":" + second;
	}

	 // JS JARED


 /* CAMBIO DE COLOR LIKE */

	$('.fa-heart-o').hover(
	function(){$(this).toggleClass('fa-heart fa-heart-o');}
	);

	// Función para tooltips

	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
	});
        
        // Función Mostrar Facturacion
        $(".form-factura").hide();
        $(".facturar").click(function() {
            if($(this).is(":checked")) {
                $(".form-factura").show(600);
            } else {
                $(".form-factura").hide(200);
            }
        });
        
        // Función Mostrar forma de pago
        $(".tdec-cont").hide();
        $(".tdec-select").click(function() {
            if($(this).is(":checked")) {
                $(".tdec-cont").show(600);
                $(".paypal-cont").hide(600);
            } else {
                $(".paypal-cont").show(200);
            }
        });
        $(".paypal-select").click(function() {
            if($(this).is(":checked")) {
                $(".tdec-cont").hide(600);
                $(".paypal-cont").show(600);
            } else {
                $(".tdec-cont").hide(200);
            }
        });
});


