<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\ProviderComponent;
use App\Http\Livewire\ProductComponent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\UserComponent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('auth/login'); })->name('home');

/*
 * Rutas componentes Livewire
 */
Route::middleware(['auth:sanctum'])->get('/proveedores', ProviderComponent::class)->name('provider');
Route::middleware(['auth:sanctum'])->get('/productos', ProductComponent::class)->name('product');
Route::middleware(['auth:sanctum'])->get('/pedidos', OrderComponent::class)->name('order');
Route::middleware(['auth:sanctum'])->get('/usuarios', UserComponent::class)->name('user');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');
