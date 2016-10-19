var main = function () {
    var menuMovil = function() {
        var $lastSub;
        $('.menumain li').each(function() {
            $(this).find('a').on('click', function(e) {
                if($lastSub){
                    $lastSub.hide();
                }
                if($(this).next().hasClass('cajasubmenu')) {
                    e.preventDefault();
                    $lastSub = $(this).siblings('.cajasubmenu').slideToggle('fast');
                }
            });
        });

        $('.cajasubmenu').mouseleave(function() {
            $('.cajasubmenu').slideUp('fast');
        });

        $('#btnmenuemergente').on('click', function(e) {
            e.preventDefault();
            $('.menuemergente').slideDown('fast');
        });

        $('.iconocierre').on('click', function(e) {
            e.preventDefault();
            $('.menuemergente').slideUp('fast');
        });

        $('.btncatalogo').on('click', function(e) {
            e.preventDefault();
            $('.menumainmovil').toggle('slide', 'fast');
        });

        $('.menumainmovil [data-btnsub]').each(function() {
            $(this).on('click', function(e) {
                e.preventDefault();
                var elemento = $(this).data('btnsub');
                if(elemento !== '') {
                    $('[data-mnusub="'+elemento+'"]').toggle('slide', 'fast');
                }
            });
        });

        $('.menumainmovil .btncerrar').each(function() {
            $(this).on('click', function(e) {
                e.preventDefault();
                $(this).parent().parent().toggle('slide', 'fast');
            });
        });
    };

    var botones = function() {
        $('.cajacantidad a.btnmenos').on('click', function(e) {
            e.preventDefault();
            var total = parseInt($('.cajacantidad #cantidad').val())-1;

            if(total < 1) {
                total = 1;
            }

            $('.cajacantidad #cantidad').val(total);
        });

        $('.cajacantidad a.btnmas').on('click', function(e) {
            e.preventDefault();
            var total = parseInt($('.cajacantidad #cantidad').val())+1;
            $('.cajacantidad #cantidad').val(total);
        });

        $('#factura').on('click', function() {
            if($(this).is(':checked')) {
                $('.cajafactura').slideDown('fast');
            } else {
                $('.cajafactura').slideUp('fast');
            }
        });

        $('#didentica').on('click', function() {
           if($(this).is(':checked')) {
                $('[data-fact]').each(function() {
                    $('#' + $(this).data('fact')).val($(this).val());
                });
            } else {
                $('[data-fact]').each(function() {
                    $('#' + $(this).data('fact')).val('');
                });
            } 
        });
    };

    var ofertas = function() {
        $('#owl-offerts').owlCarousel({
            autoPlay: 5000,
            pagination: true,
            items: 3,
            itemsDesktop: [1024, 3],
            itemsDesktopSmall: [960, 3],
            itemsTablet: [768, 2],
            itemsMobile: [480, 1] 
        });
    };

    var marcas = function() {
        $('#owl-marcas').owlCarousel({
            autoPlay: 5000,
            pagination: false,
            items: 5,
            itemsDesktop: [1024, 5],
            itemsDesktopSmall: [960, 4],
            itemsTablet: [768, 2],
            itemsMobile: [480, 1] 
        });
    };

    var metodos = function() {
        $('#owl-metodos').owlCarousel({
            autoPlay: 5000,
            pagination: false,
            items: 5,
            itemsDesktop: [1024, 5],
            itemsDesktopSmall: [960, 4],
            itemsTablet: [768, 2],
            itemsMobile: [480, 1] 
        });
    };

    var detalle = function() {
        $('#owl-detalle').owlCarousel({
            autoPlay: 5000,
            pagination: true,
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [960, 3],
            itemsTablet: [768, 2],
            itemsMobile: [480, 1] 
        });
    };

    var otrosproductos = function() {
        $('#owl-otros').owlCarousel({
            autoPlay: 5000,
            pagination: true,
            items: 4,
            itemsDesktop: [1024, 4],
            itemsDesktopSmall: [960, 3],
            itemsTablet: [768, 2],
            itemsMobile: [480, 1] 
        });
    };

    return {
        init: function () {
            menuMovil();
            botones();
            ofertas();
            marcas();
            metodos();
            detalle();
            otrosproductos();
        }
    };
}();

(function($) {
    main.init();
})(jQuery);