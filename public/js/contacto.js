var contacto = (function (window, undefined) {
    var mapa = function() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(20.6718039,-103.4254233);
        var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];
        
        var mapOptions = {
            zoom: 17,
            scrollwheel: false,
            panControl: false,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: styles
        }

        map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

        var point = new google.maps.LatLng(20.6718039,-103.4254233);
        var marca = new google.maps.Marker({ map: map, 
                                             draggable: false,
                                             position: point
                                          });
    };

    var mensajes = { 'es' : { 'error'   : '<h3>Encontramos algunos errores.<br />Corrija e intente enviar nuevamente.</h3>',
                              'enviado' : '<h3>Su mensaje ha sido enviado.</h3>',
                              'fallo'   : '<h3>Ha habido un error.<br />Trate más tarde</h3>' },
                     'en' : { 'error'   : '<h3>We found a few errors.<br />Correct and try sending again.</h3>',
                              'enviado' : '<h3>Your message has been sent.</h3>',
                              'fallo'   : '<h3>There has been an error.<br />Try Later</h3>' }
                   };
    var alertas;

    var setAlertas = function(idioma) {
        switch(idioma) {
            case 'es':
                alertas = mensajes.es;
            break;

            case 'en':
                alertas = mensajes.en;
            break;
        }
    };

    var form = '#';

    var validarEmail = function (email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email);
    };

    var tipos = function(valor, tipo) {
        var res = 1;

        switch(tipo) {
            case 'txt':
                if(valor.length == 0) { 
                    res = 0;
                }
            break;
            case 'mail':
                if(valor.length == 0 || validarEmail(valor) == false) { 
                    res = 0;
                }
            break;
        }

        return res;
    };

    var valida = function() {
        var res = 1;
        $(form+' input[data-required="1"]').each(function(index) {
            if($(this).attr('type') != 'checkbox') {
                if(!tipos($(this).val(), $(this).attr('data-tipo'))) {
                    $(this).addClass('inputError');
                    res = 0;
                }
            } else {
                if(!$(this).is(':checked')) {
                    $(this).parent().addClass('inputError');
                    res = 0;
                }
            }
        });

        $(form+' textarea[data-required="1"]').each(function(index) {
            if(!tipos($(this).val(), $(this).attr('data-tipo'))) {
                $(this).addClass('inputError');
                res = 0;
            }
        });

        $(form+' select[data-required="1"]').each(function(index) {
            if(!tipos($(this).val(), $(this).attr('data-tipo'))) {
                $(this).addClass('inputError');
                res = 0;
            }
        });

        return res;
    };

    var limpiar = function() {
        $(form+' input[data-required="1"]').each(function(index) {
            $(this).removeClass('inputError');
            $(this).parent().removeClass('inputError');
        });

        $(form+' textarea[data-required="1"]').each(function(index) {
            $(this).removeClass('inputError');
        });

        $(form+' select[data-required="1"]').each(function(index) {
            $(this).removeClass('inputError');
        });
    };

    var enviar = function(idenviar) {
        $('#'+idenviar).on('click', function(e) {
            e.preventDefault();
            limpiar();
            if(valida()) {
                $(form).submit();
            } else {
                $('#txtAlerta').html(alertas.error);
                $('#alertaModal').modal();
            }
        });
    };

    var alerta = function(idioma) {
        setAlertas(idioma);

        var res = $('#enviado').val();

        if(res == '1') {
            $('#txtAlerta').html(alertas.enviado);
            $('#alertaModal').modal();
        } else if(res == '0') {
            $('#txtAlerta').html(alertas.fallo);
            $('#alertaModal').modal();
        }
    };

    return {
        init : function(idmapa, idcontenedor, idform, idioma, idenviar) {
            if($('#'+idmapa).length) {
                mapa();
            }

            // if($('#'+idcontenedor).length) {
            //     var formulario = $('#'+idcontenedor).html();
            //     var action = $('#'+idcontenedor).data('action');
            //     var method = $('#'+idcontenedor).data('method');
            //     var formtag = $('<form>');
            //     formtag.attr({ 'id'     : 'contacto',
            //                    'action' : action,
            //                    'method' : method }).append(formulario);
            //     $('#'+idcontenedor).html('').append(formtag);

            //     form += idform;
            //     alerta(idioma);
            //     enviar(idenviar);
            // }
        }
    };
})(window);

(function($) {
    contacto.init('mapa', 'formcontacto', 'formcontacto', 'es', 'btnenviar');
})(jQuery);