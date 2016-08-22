$(document).ready(function () {
    //Fancybox login
    //$('.link-perfil').click(function(e){
    //	e.preventDefault();
    //	$('.fancy-login').fadeIn(500);
    //});

    $('.fancy-login, .cerrar-fancybox').click(function () {
        $('.fancy-login').fadeOut(500);
    });
    //return;
    //Llamada de productos destacados
    /*
    $.get("ajax_call/ws_destacados.php", function (data, status) {
        html = data;
        //Data será un JSON con los datos de los productos destacados
        if (status == "success") {
            $('#destacados .container .row').html(html);
            //$('#destacados').html('<p>No se encontraron proudctos destacados</p>');
        } else {
            $('#destacados .container .row').html('<p>Hubo un error en la obtención de datos</p>');
        }
    });
*/
    var page = 1;
    var stopGetProducts = false;
    function get_products(pag) {
        if(stopGetProducts){
            return;
        }
        //Llamada de listado de productos
        var url = laroute.route('auction.list-upcoming');
        $.get(url, {
            page : page
        }, function (data, status) {
            html = data;
            if(html=="false"){
                stopGetProducts = true;
                return;
            }
            //Data será un JSON con los datos de los productos destacados
            if (status == "success") {
//                html += $('#listado-home .container-fluid .row').html();
                $('#listado-home .container-fluid .row').append(html);
                //$('#destacados').html('<p>No se encontraron proudctos destacados</p>');
            } else {
                $('#listado-home .container-fluid .row').append('<p>Hubo un error en la obtención de datos</p>');
            }
            page++;
        });
    }
    get_products();
    $('.slideshow.container').show();
    var revSli = $('.banner').revolution({
        delay: 9000,
        startwidth: 960,
        startheight: 500,
        startWithSlide: 0,
        maxVisibleItems: 10,
        fullScreenAlignForce: "off",
        autoHeight: "off",
        shuffle: "off",
        onHoverStop: "on",
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideTimerBar: "on",
        navigationType: "bullet",
        navigationArrows: "solo",
        navigationStyle: "round",
        touchenabled: "on",
        swipe_velocity: "0.7",
        swipe_max_touches: "1",
        swipe_min_touches: "1",
        drag_block_vertical: "false",
        stopAtSlide: -1,
        stopAfterLoops: -1,
        visibleItems: 6,
        slideshowOn: true,
        useGlobalDelay: true,
        openOnRollover: true
        /*
         hideThumbsUnderResoluition:0,
         keyboardNavigation:"on",
         hideThumbs:0,
         
         thumbWidth:100,
         thumbHeight:50,
         thumbAmount:3,
         
         hideThumbsOnMobile:"off",
         hideNavDelayOnMobile:1500,
         
         navigationHAlign:"center",
         navigationVAlign:"bottom",
         navigationHOffset:30,
         navigationVOffset:30,
         
         soloArrowLeftHalign:"left",
         soloArrowLeftValign:"center",
         soloArrowLeftHOffset:20,
         soloArrowLeftVOffset:0,
         
         soloArrowRightHalign:"right",
         soloArrowRightValign:"center",
         soloArrowRightHOffset:20,
         soloArrowRightVOffset:0,
         
         hideCaptionAtLimit:0,
         hideAllCaptionAtLilmit:0,
         hideSliderAtLimit:0,
         
         dottedOverlay:"none",
         
         spinned:"spinner4",
         
         fullWidth:"off",
         forceFullWidth:"off",
         fullScreen:"off",
         fullScreenOffsetContainer:"#header-offset, #offsetSlider",
         */
    });
    console.log($('.tp-bgimg').css('background-size','auto'));
    
    
    revSli.bind("revolution.slide.onchange", function (e, data) {
        console.log("change");
        //$('.subasta-tiempo').css('opacity','0');
        $('.banner-name').css('opacity', '0');
        $('.banner-data').css('opacity', '0');
    });

    var ant_exp;
    setInterval(function () {
//        console.log($('.current-sr-slide-visible'));
//        console.log($('.current-sr-slide-visible').attr('product-name'));
        var exp = $('.current-sr-slide-visible').attr('expiration');
        var max = $('.current-sr-slide-visible').attr('rangomax');
        var min = $('.current-sr-slide-visible').attr('rangomin');
        var name = $('.current-sr-slide-visible').attr('product-name');
        var id = $('.current-sr-slide-visible').attr('id-producto');
        if (ant_exp != exp||true) {
            $('.subasta-tiempo').attr('expiration', exp);
            $('.link-subasta').attr('id_producto',id);
            $('.banner-name span').html(name);
            $('.rango-min').html(min);
            $('.rango-max').html(max);
            setTimeout(function () {
                $('.banner-name').css('opacity', '1');
                $('.banner-data').css('opacity', '1');
            }, 800);
            ant_exp = exp;
        }
    }, 100);
    
    window.onscroll = function (ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            get_products();
        }
    };

    $('.btn-perfil').click(function () {
        $(this).siblings('button').removeClass('perfil-activo');
        $(this).addClass('perfil-activo');
    });
});