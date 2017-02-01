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
        $('.menumain>li').mouseleave(function(){
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
            items: 3,
            autoplay: false,
            dots: false,
            loop: false,
            nav: false,
            touchDrag: false,
            mouseDrag: false,
            responsive:{
                 0:{
                    items:1,
                    autoplay: true,
                    dots: true,
                    loop: true
                },
                480:{
                    items:1,
                    autoplay: true,
                    dots: true,
                    loop: true
                },
                768:{
                    items:3
                },
                960:{
                    items:3
                },
                1024:{
                    items:3
                }
            } 
        });
    };

    var marcas = function() {
        $('#owl-marcas').owlCarousel({
            items: 5,
            autoplay: true,
            dots: false,
            loop:true,
            nav:false,
            margin: 20,
            responsive:{
                0:{
                    items:3
                },
                480:{
                    items:3
                },
                768:{
                    items:4
                },
                960:{
                    items:4
                },
                1024:{
                    items:5
                }
            }
        });
    };

    var metodos = function() {
        $('#owl-metodos').owlCarousel({
            items: 5,
            autoplay: true,
            dots: false,
            loop: true,
            nav: false,
            responsive:{
                0:{
                    items:3
                },                
                480:{
                    items:3
                },
                768:{
                    items:3
                },
                960:{
                    items:4
                },
                1024:{
                    items:5
                }
            } 
        });
    };

    var detalle = function() {
        $('#owl-detalle').owlCarousel({
            items: 4,
            autoplay: true,
            dots: false,
            loop: true,
            nav: false,
            responsive:{
                0:{
                    items:1
                },                
                480:{
                    items:1
                },
                768:{
                    items:2
                },
                960:{
                    items:3
                },
                1024:{
                    items:4
                }
            } 
        });
    };

    var otrosproductos = function() {
        $('#owl-otros').owlCarousel({
            items: 4,
            autoplay: false,
            dots: false,
            loop: false,
            nav: false,
            responsive:{
                0:{
                    items:1,
                    autoplay: true,
                    dots: true,
                    loop: true
                },                
                480:{
                    items:1
                },
                768:{
                    items:3,
                    dots: true,
                    loop: true
                },
                960:{
                    items:3,
                    dots: true,
                    loop: true
                },
                1024:{
                    items:4
                }
            } 
        });
    };

    var estrellas = function() {
        $('#owl-estrellas').owlCarousel({
            items: 1,
            autoplay: true,
            dots: false,
            loop:true,
            nav:false,
            responsive:{
                0:{
                    items:1
                },                
                480:{
                    items:1
                },
                768:{
                    items:1
                },
                960:{
                    items:1
                },
                1024:{
                    items:1
                }
            }
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
