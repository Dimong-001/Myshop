<?php
use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\Api\SlideshowApiController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Slideshow;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Category;
use App\Http\Controllers\Api\CategoryApiController;



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

Route::get('/slideshow', [App\Http\Controllers\SlideshowController::class, 'index'])->name('slideshow.index');

Route::get('/api/slideshows', [App\Http\Controllers\SlideshowController::class, 'apiIndex']);
Route::get('/slideshows', [SlideshowController::class, 'apiIndex']);
Route::get('/slideshows', [SlideshowApiController::class, 'index']);
Route::get('/slideshows/{id}', [SlideshowAPIController::class, 'show']);
Route::get('/slideshows', 'SlideshowController@index');
Route::get('/slideshows', [SlideshowController::class, 'index']);
Route::get('/public/slideshows', [App\Http\Controllers\API\PublicApiController::class, 'slideshows']);


Route::get('/public-slideshows', function() {
    return \App\Models\Slideshow::all();
});

Route::get('/slideshows', function () {
    return \App\Models\Slideshow::all();
});

Route::get('/slideshows', function () {
    return response()->json(Slideshow::orderBy('order', 'asc')->get());
});
// Product Management Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
});
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public API endpoints
Route::prefix('api')->group(function () {
    // Slideshow endpoints
    Route::get('/slideshows', function () {
        return response()->json(Slideshow::where('show', true)->orderBy('order', 'asc')->get());
    });
    
    // Detailed API controller endpoints
    Route::get('/slideshows/all', [SlideshowApiController::class, 'index']);
    Route::get('/slideshows/{id}', [SlideshowApiController::class, 'show']);
});

// Public slideshows endpoint (for frontend apps)
Route::get('/public-slideshows', function() {
    return response()->json(
        Slideshow::where('show', true)
            ->orderBy('order', 'asc')
            ->get()
            ->map(function($slideshow) {
                return [
                    'id' => $slideshow->id,
                    'title' => $slideshow->title,
                    'subtitle' => $slideshow->subtitle,
                    'text' => $slideshow->text,
                    'image' => $slideshow->image,
                    'link' => $slideshow->link,
                    'order' => $slideshow->order
                ];
            })
    );
});
Route::prefix('api')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
    Route::post('/products', [ProductApiController::class, 'store']);
    Route::put('/products/{id}', [ProductApiController::class, 'update']);
    Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);
});
// routes/api.php
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
});
Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('/admin/categories', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

Route::get('/categories', [\App\Http\Controllers\Api\CategoryApiController::class, 'index']);
Route::get('/categories', function () {
    return response()->json(Category::where('is_active', true)->get());
});
Route::get('/categories', function () {
    return response()->json(
        Category::where('is_active', true)
                ->orderBy('id', 'desc')
                ->get()
    );
});
Route::get('/categories', function () {
    return response()->json(Category::all());
});
// GET /api/categories (for frontend use)
// Authentication routes (if you're using Laravel's built-in auth)
Auth::routes();