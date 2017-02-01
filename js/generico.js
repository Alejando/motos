var main = function () {
    var menuMovil = function() {
        var $lastSub;
        $('.menumain li').each(function() {
            var $this = $(this);
            $this.find('a').on('click', function(e) {
                var $li = $this.find(">div");
                if($li.is(':visible')){
                    window.open(this.href, '_self');
                } else {
                    if($lastSub){
                        $lastSub.hide();
                    }
                    if($(this).next().hasClass('cajasubmenu')) {
                        e.preventDefault();
                        $lastSub = $(this).siblings('.cajasubmenu').slideToggle('fast');
                    }
                }
            });
            var time;
            $this.mouseenter(function() {
                var $self = $(this);
                var $miSubmenu = $self.find('.cajasubmenu');
                if(!$miSubmenu.is(':visible')){
                    clearTimeout(time);
                    time = setTimeout(function() {
                        clearTimeout(time);
                        $self.closest('ul').find('.cajasubmenu').slideUp(100);
                        $self.find('.cajasubmenu').slideDown(150); 
                    },200);
                }
            });
           
        });
        $('.menumain>li, .menumain').mouseleave(function(){
            $(this).find('.cajasubmenu').slideUp(100);
        });
        var time2;
        $('.cajasubmenu').mouseleave(function() {
            var $self = $(this);
            clearTimeout(time2);
            var time2 = setTimeout(function(){
                clearTimeout(time2);
                if(!$self.closest("li").find("a:hover").length){
                    $('.cajasubmenu').slideUp('fast');
                }
            },50);
            
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
            $('body').css('overflow', 'hidden');
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
                if(!$('.submenumovil:visible').length){
                    $('body').css('overflow', 'scroll');    
                }
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

    var estrellas = function() {
        $('#owl-estrellas').owlCarousel({
            autoPlay: 5000,
            pagination: false,
            items: 1,
            itemsDesktop: [1024, 5],
            itemsDesktopSmall: [960, 4],
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
            estrellas();
            metodos();
            detalle();
            otrosproductos();
        }
    };
}();

(function($) {
    main.init();
})(jQuery);