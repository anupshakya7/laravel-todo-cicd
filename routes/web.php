<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mobile-add-cart', function () {
    session([
        'cart' => [
            [
                "item" => "Samsung Galaxy A7",
                "price" => 25000
            ],
            [
                "item" => "Iphone 15",
                "price" => 125000
            ],
            [
                "item" => "Samsung Galaxy s24",
                "price" => 105000
            ]
        ]
    ]);
    $items = session()->get('cart');
    return $items;
});

Route::get('/post-fetch',function(){
    $posts = Post::active()->get();

    // $categories = Category::first();
    // $data = $categories->posts()->active(false)->postDetail()->get()->toArray();

    // $categories = Category::with(['posts'=>function($q){
    //     $q->active()->postDetail();
    // }])->get();

    dd($posts->toArray());
    // dd($posts->toArray());
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
