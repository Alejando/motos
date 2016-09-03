var pathArray = location.href.split('/');
var protocol = pathArray[0];
var host = pathArray[2];
var url = protocol + '//' + host + '/' + 'glimglam';
function slugify(text){
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}
$(document).ready(function () {
    $('.fancy-producto').on('click', '.fancy-gallery-control', function () {
        var $control = $(this);
        var $container = $('.fancy-gallery');
        var position = $container.scrollLeft();
        var numGal = parseInt($('.frame-gallery.active').attr('gal-num'));
        $('.frame-gallery.active').removeClass('active');
        if ($control.hasClass('control-right') && numGal < numItems) {
            $container.scrollLeft(position + 104);
            numGal += 1;
        } else if ($control.hasClass('control-right') && numGal == numItems){
            $container.scrollLeft(0);
            numGal = 0;
        } else if ($control.hasClass('control-left') && numGal > 0) {
            $container.scrollLeft(position - 104);
            numGal -= 1;
        } else if($control.hasClass('control-left') && numGal == 0){
            $container.scrollLeft((numItems-1)*104);
            numGal = numItems;
        }
        console.log(numGal);
        $('.frame-gallery.gal-' + numGal).addClass('active');
        changeGalImg($('.frame-gallery.active'));
    });

    $('.fancy-producto').on('click', '.frame-gallery', function (e) {
        e.preventDefault();
        var $element = $(this);

        $('.frame-gallery.active').removeClass('active');
        $element.addClass('active');

        changeGalImg($element);
    });
    var zoomConfig = {
        responsive: true,
        scrollZoom: true,
        gallery: 'galeria-fancy',
        borderSize: 1,
        zoomType: "window",
        zoomWindowWidth: 400,
        zoomWindowHeight: 400,
        zoomWindowOffetx:60,
        zoomWindowOffety:-30,
        tintOpacity: 1,
        easing: true,
        zIndex: 20005
    };
    function changeGalImg($element) {
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
    window.open_fancy_product = function (code) {
        var url_ajax = laroute.route('enrollment.userIsEnrollment', {'auctionCode': code});
        $.get(url_ajax, {}, function (data) {
            if (data.enrollment) {
                var redirection = laroute.route('auction.room', {'code': code});
                window.location = redirection;
            } else {
                var url = laroute.route('auction.fancy', {code: code});
                $.get(url, {}, 'html').done(function (html) {
                    var $html = $(html);
                    var $zoom = $html.find(".zoom_mw").elevateZoom(zoomConfig);
                    $('.fancy-producto').empty().append($html).fadeIn(500);
                    var $link = $('.fancy-producto').empty().append($html).find('.link-subasta, .google-calendar, .share-room');
                    $link.click(function(){
                        if($(this).is('.google-calendar')){
                            window.open(this.href,'_blank');
                        }else if($(this).is('.share-room.share-tw')){
                            $(this).customerPopup(e);
                        }else{
                            window.open(this.href,'_self');
                        }
                    });
                });
            }

        });
    };
    window.openFancyByHash = function(hash){
        var h = hash.replace("#!","").split("/")[0];
        open_fancy_product(h);
    };
    $('.producto-fancy').on('click', function (e) {
        e.stopPropagation();
    });
    var $products = $('.products-container .container .row, .products-container .container-fluid .row, .relacionados .container .row, .banner-description, .banner-list');
    $products.on('click', '.producto-hammer, .link-subasta', function (e) {
        e.preventDefault();
        var $this =$(this);
        var code = $this.attr('id_producto');
        var slug = $this.closest('.product-container, .banner-description, .element-banner-list').data('slug');
        var title = this.dataset.slug;
        history.pushState( null, null, "#!" + code + '/' + slug );
        openFancyByHash(code);
    });

    $products.on('click', '.producto-heart', function (e) {
        var $this = $(this);
        var code = $this.closest('.link-subasta').attr('id_producto');
        if (!$this.is('.in-fav')) {
            jsGlimglam.fn.auctions.addFav(code).done(function () {
                $this.addClass('in-fav');
            });
//            
        } else {
            jsGlimglam.fn.auctions.removeFav(code).done(function () {
                $this.removeClass('in-fav');
            });
        }
        return false;
    });


    var $fancyProducto = $('.fancy-producto');
    $fancyProducto.click(function (e) {
        if ($(e.target).is('.fancy-producto') ||
                $(e.target).is('.close-fancy')) {
            $fancyProducto.fadeOut(500,function(){
                history.pushState( null, null, "#" );
            });
        } else {
            return false;
        }

    });



    /* Funcionalidad scroll btn subir */
    $(window).scroll(function () {
        var top = $(window).scrollTop();
        if (top > 150) {
            $('.subir').addClass('subir-activo');
        } else {
            $('.subir').removeClass('subir-activo');
        }
    });

    var scrollAnimation = false;
    $('.subir').click(function () {
        scrollTop();
        return false;
    });

    function scrollTop() {
        scrollAnimation = true;
        $('body,html').animate({scrollTop: 0}, 500, function () {
            scrollAnimation = false;
        });
        return false;
    }

    /* Funcionalidad general para menu principal */
    $('#link-menu, .cerrar-principal').click(function (e) {
        e.preventDefault();
        $('#link-menu').toggleClass("menu-activo");
        $('.menu-principal').toggleClass('menu-activo');
        //$('body').toggleClass('no-scroll');
    });
    /* Funcionalidad general para menu busqueda */
    $('#link-search, .cerrar-search').click(function (e) {
        e.preventDefault();
        $('#link-search').toggleClass("menu-activo");
        $('.menu-search').toggleClass('menu-activo');
        //$('body').toggleClass('no-scroll');
    });

    /* Termina funcionalidad general para menu */

    /* Funcionalidad de contador */
    setInterval(function () {
        $('.countdown').each(function () {
            var start_date = $(this).attr('start_date');
//            console.log(start_date);
            var rest = timer(start_date);
//            console.log("timer=>",rest);
            htmlTime = '';
            if (rest.tipo) {
                if (rest.dd > 1) {
                    htmlTime += rest.dd + ' días ' + rest.hh + ':' + rest.mm + ':' + rest.ss;
                } else if (rest.dd == 1) {
                    htmlTime += rest.dd + ' día ' + rest.hh + ':' + rest.mm + ':' + rest.ss;
                } else if (rest.hh > 1) {
                    htmlTime += rest.hh + ':' + rest.mm + ':' + rest.ss + ' horas';
                } else if (rest.hh == 1) {
                    htmlTime += rest.hh + ' hora ' + rest.mm + ':' + rest.ss;
                } else if (rest.mm > 1) {
                    htmlTime += rest.mm + ':' + rest.ss + ' minutos';
                } else if (rest.mm == 1) {
                    htmlTime += rest.mm + ':' + rest.ss + ' minuto';
                } else if (rest.ss > 0) {
                    htmlTime += rest.mm + ':' + rest.ss + ' segundos';
                } else {
                    htmlTime += 'subasta iniciada';
                }
            } else {
                htmlTime += 'subasta iniciada';
            }

            $(this).html(htmlTime);
        });
    }, 1000);

    function timer(exp) {//La fecha de termino tiene que estar asi 2011-04-11T11:51:00
        exp = new Date(exp);
        var diff = exp - new Date();
        if (diff > 0) {
            diff = (Math.round(diff / 1000));

            var seconds = diff % 60;

            var minutes = Math.floor(diff / 60);
            var hours = Math.floor(minutes / 60);
            var days = Math.floor(hours / 24);
            console.log(days);
            minutes %= 60;
            hours %= 24;

            seconds = ("0" + seconds).slice(-2);
            minutes = ("0" + minutes).slice(-2);
            hours = ("0" + hours).slice(-2);

            var remaining = {"tipo": 1, "dd": days, "hh": hours, "mm": minutes, "ss": seconds};
        } else {
            var remaining = {"tipo": 0};
        }

        //console.log(remaining);
        return remaining;
    }

    function get_date_time() {
        now = new Date();
        year = "" + now.getFullYear();
        month = "" + (now.getMonth() + 1);
        if (month.length == 1) {
            month = "0" + month;
        }
        day = "" + now.getDate();
        if (day.length == 1) {
            day = "0" + day;
        }
        hour = "" + now.getHours();
        if (hour.length == 1) {
            hour = "0" + hour;
        }
        minute = "" + now.getMinutes();
        if (minute.length == 1) {
            minute = "0" + minute;
        }
        second = "" + now.getSeconds();
        if (second.length == 1) {
            second = "0" + second;
        }
        return year + "-" + month + "-" + day + "T" + hour + ":" + minute + ":" + second;
    }

    // JS JARED


    /* CAMBIO DE COLOR LIKE */

    $('.fa-heart-o').hover(
            function () {
                $(this).toggleClass('fa-heart fa-heart-o');
            }
    );

    // Función para tooltips

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    

    // Función Mostrar forma de pago
    $(".tdec-cont").hide();
    $(".tdec-select").click(function () {
        if ($(this).is(":checked")) {
            $(".tdec-cont").show(600);
            $(".paypal-cont").hide(600);
        } else {
            $(".paypal-cont").show(200);
        }
    });
    $(".paypal-select").click(function () {
        if ($(this).is(":checked")) {
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


