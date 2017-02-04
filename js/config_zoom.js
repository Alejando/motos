console.log('init elevateZoom');


$( document ).ready(function() {
    $("#fancy-zoom").elevateZoom({
	  zoomType	: "lens",
	  lensShape : "round",
	  lensSize    : 200
	});
});