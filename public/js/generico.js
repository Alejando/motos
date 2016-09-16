var main = function () {
    var menuMovil = function() {
        $('.menumain li').each(function() {
            $(this).find('a').on('click', function(e) {
                if($(this).next().hasClass('cajasubmenu')) {
                    e.preventDefault();
                    $('.cajasubmenu').slideToggle('fast');
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

        /*$('.btnMovil').on('click', function(e) {
            e.preventDefault();
            $('.submenu').slideToggle('fast');
        });

        $('.submenu').mouseleave(function() {
            $('.submenu').slideToggle('fast');
        });

        $('#btnmovil').on('click', function(e) {
            e.preventDefault();
            if($('.menumovil').css('display') == 'none') {
                $('.menumovil').slideDown('fast');
            } else {
                $('.menumovil').slideUp('fast');
            }
        });

        $('.menumovil').mouseleave(function() {
            $('.menumovil').slideUp('fast');
        });*/
    }

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
    }

    return {
        init: function () {
            menuMovil();
            botones();
        }
    };
}();

(function($) {
    main.init();
})(jQuery);