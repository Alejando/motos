var main = function () {
    var menuMovil = function() {
        var menuMovil=false;
        var menuBike=false;
        var menuBoutique=false;

        //Función para mostrar y ocultar menu
        if($(window).width()<950){
            $( "#menuMovilButton" ).click(function() {
                console.log(menuMovil);
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
                $('#subMenuMotos').stop().slideDown('fast');
            });     
            $("#menuMotosWeb").mouseleave(function () {
                $('#subMenuMotos').stop().slideUp('fast');
            });
            $( "#menuBoutiqueWeb" ).mouseover(function() {
                $('#subMenuBoutique').stop().slideDown('fast');
            });     
            $("#menuBoutiqueWeb").mouseleave(function () {
                $('#subMenuBoutique').stop().slideUp('fast');
            });
        }
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

    var slidePrincipal = function() {
       $('#owlSliderPrincipal').owlCarousel({
            loop:true,
            responsiveClass: true,
            autoPlay: 5000,
            pagination: false,
            responsive: {
                  0: {
                    items: 1,
                    nav: false,
                    dots: true
                  },
                  600: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                  }
                }
        });
    };
    var slideMotos = function() {
       $('#owlSlideMotos').owlCarousel({
            loop:true,
            responsiveClass: true,
            autoPlay: 5000,
            pagination: false,
            responsive: {
                  0: {
                    items: 1,
                    nav: false,
                    dots: true
                  },
                  600: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                  }
                }
        });
    };

   


    return {
        init: function () {
            menuMovil();
            slidePrincipal();
            slideMotos();
        }
    };
}();


    function closeAllSubMenus() {
        $('.header_sub_ul').slideUp( "slow");
        $('.icon_caret').removeClass( "fa-caret-down" ).addClass( "fa-caret-right" );
        menuBoutique=false;
        menuMotos=false;
    }

(function($) {
    main.init();
})(jQuery);
