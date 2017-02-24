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
    return view('public/pages/notice-privacy');
});

Route::get('vision', function () {
    return view('public/pages/notice-privacy');
});

Route::get('compromiso', function () {
    return view('public/pages/notice-privacy');
});
