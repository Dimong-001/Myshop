<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
// Route::get('/', function () {
//     $slideshows=[
//         ['titile'=>'Promotion 1', 'subtitle'=>'Special discount 10%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
//         ['titile'=>'Promotion 2', 'subtitle'=>'Special discount 20%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-2.jpg'],
//         ['titile'=>'Promotion 3', 'subtitle'=>'Special discount 40%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
//         ['titile'=>'Promotion 4', 'subtitle'=>'Special discount 50%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
//         ['titile'=>'Promotion 5', 'subtitle'=>'Special discount 70%', 'text'=>'On Chiness New Year', 'link'=>'#', 'image'=>'slide-1.jpg'],
//     ];
//     return view('index', compact('slideshows'));
// });

Route::get('/', [IndexController::class, 'index']);

Route::get('/shop', function () {
    return view('shop');
});
Route::get('/login', function () {
    return view('admin.index');
});