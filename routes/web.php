<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $slideshows=[
        ['titile'=>'Promotion 1', 'subtitle'=>'Special discount 10%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
        ['titile'=>'Promotion 2', 'subtitle'=>'Special discount 20%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-2.jpg'],
        ['titile'=>'Promotion 3', 'subtitle'=>'Special discount 40%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
    ];
    return view('index', compact('slideshows'));
});

Route::get('/shop', function () {
    return view('shop');
});