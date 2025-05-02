<?php
use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SlideshowController;
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
Route::get('/admins', function () {
    return view('admin.index');
});
Route::get('/slideshow', [SlideshowController::class, 'index'])->name('slideshow.index');

Route::get('/product', function () {
    return view('admin.product');
});
Route::get('/category', function () {
    return view('admin.category');
});
Route::get('/slideshow/delete/{id}', [SlideshowController::class, 'destroy'])->name('slideshow.delete');
Route::get('/slideshow/enable_disable/{id}', [SlideshowController::class, 'enable_disable'])->name('slideshow.enable_disable');

Route::get('/slideshow/move-up/{id}', [SlideshowController::class, 'move_up'])->name('slideshow.move_up');
Route::get('/slideshow/move-down/{id}', [SlideshowController::class, 'move_down'])->name('slideshow.move_down');
Route::get('create', [SlideshowController::class, 'loadSlideshowForm'])->name('slideshow.createslideshow');

Route::post('slideshow/create', [SlideshowController::class, 'create'])->name('slideshow.create');


Auth::routes();

Route::get('/login', [App\Http\Controllers\HomeController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
