<?php


Route::get('/', function () {
    return view('public/pages/home');
});

Route::get('aviso-de-privacidad', function () {
    return view('public/pages/notice-privacy');
});

Route::get('acerca-de', function () {
    return view('public/pages/about-ktm');
});

Route::get('filosofia', function () {
    return view('public/pages/about-ktm');
});

Route::get('vision', function () {
    return view('public/pages/about-ktm');
});

Route::get('compromiso', function () {
    return view('public/pages/about-ktm');
});
Route::get('detalles-de-producto', function () {
    return view('public/pages/product-details');
});

Route::get('contacto', function () {
    return view('public/pages/contact');
});
