var pathArray = location.href.split( '/' );
var protocol = pathArray[0];
var host = pathArray[2];
var url = protocol + '//' + host + '/' + 'glimglam';


$(document).ready(function(){
    $('.fancy-producto').on('click', '.fancy-gallery-control',function(){
        var $control = $(this);
        var $container = $('.fancy-gallery');
        var position = $container.scrollLeft();
        var numGal = parseInt($('.frame-gallery.active').attr('gal-num'));
        $('.frame-gallery.active').removeClass('active');
        
        console.log(numGal);
        console.log(numItems);
        console.log(numGal < numItems);
        
        if($control.hasClass('control-right') && numGal < numItems){
            $container.scrollLeft(position+104);
            numGal += 1;
        }else if($control.hasClass('control-left') && numGal > 0){
            $container.scrollLeft(position-104);
            numGal -= 1;
        }
        console.log(numGal);
        $('.frame-gallery.gal-'+numGal).addClass('active');
        changeGalImg($('.frame-gallery.active'));
    });
    
    $('.fancy-producto').on('click', '.frame-gallery', function(e){
        e.preventDefault();
        var $element = $(this);
        
        $('.frame-gallery.active').removeClass('active');
        $element.addClass('active');
        
        changeGalImg($element);
    });
    
    function changeGalImg($element){
        var zoomConfig = {
            scrollZoom : true,
            gallery: 'galeria-fancy',
            borderSize : 1,
            zoomType : "inner",
            lensShape : "round",
            tintOpacity:1,
            easing:true,
            zIndex : 20005
        };
        var zoomImage = $('#fancy-zoom');
        
        // Remove old instance od EZ
        $('.zoomContainer').remove();
        zoomImage.removeData('elevateZoom');
        // Update source for images
        zoomImage.attr('src', $element.data('image'));
        zoomImage.data('zoom-image', $element.data('zoom-image'));
        // Reinitialize EZ
        zoomImage.elevateZoom(zoomConfig);
    }
                
    //Fancybox producto
    function open_fancy_product(code) {
        var url_ajax = laroute.route('enrollment.userIsEnrollment',{'auctionCode':code});
        $.get(url_ajax,{},function(data){
            if(data.enrollment){
                var redirection = laroute.route('auction.room',{'code':code});
                window.location = redirection;
            }else{
                var url = laroute.route('auction.fancy',{code : code});
                $.get(url,{},'html').done(function(html) {
                    var $html = $(html);
                    $zoom = $html.find(".zoom_mw").elevateZoom({
                        scrollZoom : true,
                        gallery: 'galeria-fancy',
                        borderSize : 1,
                        zoomType : "inner",
                        lensShape : "round",
                        tintOpacity:1,
                        easing:true,
                        zIndex : 20005
                    }); 
                    $('.zoomContainer').append()
//            $zoom.css('zIndex',2002);
//            console.log($zoom);
//            console.log($('.fancy-producto'));
                    $('.fancy-producto').empty().append($html).fadeIn(500);
                });
            }
                
        });
    }
    $('.producto-fancy').on('click', function (e) {
        e.stopPropagation();
    });
    var $products = $('.products-container .container .row, .products-container .container-fluid .row, .relacionados .container .row');
    $products.on('click', '.producto-hammer, .link-subasta', function (e) {
        e.preventDefault();
        open_fancy_product($(this).attr('id_producto'));
    });

    $('a.link-subasta, li.link-subasta').on('click', function(e){
        e.preventDefault();
        open_fancy_product($(this).attr('id_producto'));
    });
    $products.on('click','.producto-heart', function(e){
        var $this = $(this);
        var code = $this.closest('.link-subasta').attr('id_producto');
        if(!$this.is('.in-fav')){
            jsGlimglam.fn.auctions.addFav(code).done(function(){
                $this.addClass('in-fav');
            });
//            
        } else {
            jsGlimglam.fn.auctions.removeFav(code).done(function(){
                $this.removeClass('in-fav');
            });
        }
        return false;
    });
    
    
    var $fancyProducto = $('.fancy-producto');
    $fancyProducto.click(function (e) {
        if(e.target === this || $(e.target).is('.descripcion-fancy')) {
            $fancyProducto.fadeOut(500);
        }        
    });
    $fancyProducto.on('click', '.fancybox-close', function(){
        $fancyProducto.fadeOut(500);
    });
    
    
    
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

    /* Funcionalidad general para menu principal */
    $('#link-menu, .cerrar-menu').click(function(e){
            e.preventDefault();
            $('#link-menu').toggleClass("menu-activo");
            $('.menu-principal').toggleClass('menu-activo');
            //$('body').toggleClass('no-scroll');
    });
    /* Funcionalidad general para menu busqueda */
    $('#link-search, .cerrar-search').click(function(e){
            e.preventDefault();
            $('#link-search').toggleClass("menu-activo");
            $('.menu-search').toggleClass('menu-activo');
            //$('body').toggleClass('no-scroll');
    });

    /* Termina funcionalidad general para menu */

    /* Funcionalidad de contador */
    setInterval(function(){
        $('.countdown').each(function(){
            var start_date = $(this).attr('start_date');
            var rest = timer(start_date);
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
        var $subTotal = $('#enroll-sub-total');
        var $iva = $('#enroll-iva');
        var $total = $('#enroll-total');
        
        $(".facturar").click(function() {
            if($(this).is(":checked")) {
                var total = parseFloat($total.attr('cant'));
                var subTotal = (total / (window.ivaCant+1));
                var iva = parseFloat(total - subTotal);
                $iva.attr('cant',iva).html('$'+iva.toFixed(2));
                $subTotal.attr('cant', subTotal).html('$'+subTotal.toFixed(2));
                $(".form-factura").show(600);
            } else {
                var subTotal = parseFloat($total.attr('cant'));
                
                $iva.attr('cant','0.00').html('$0.00');
                $subTotal.attr('cant', subTotal.toFixed(2)).html('$'+subTotal.toFixed(2));
                
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
        
        //FUNCIÓN PARA ACORDIONES
        $('#accordion').on('show.bs.collapse', function () {
        $('#accordion .in').collapse('hide');
        });
});


