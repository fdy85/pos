<?php

use App\Http\Livewire\Admin\Branchoffices\BranchofficesIndex;
use App\Http\Livewire\Admin\Brands\BrandsIndex;
use App\Http\Livewire\Admin\Cashouts\CashoutsIndex;
use App\Http\Livewire\Admin\CashRegisters\CashRegistersIndex;
use App\Http\Livewire\Admin\Categories\CategoriesIndex;
use App\Http\Livewire\Admin\Clients\ClientsIndex;
use App\Http\Livewire\Admin\Companies\CompaniesIndex;
use App\Http\Livewire\Admin\Pos\Pos;
use App\Http\Livewire\Admin\Products\ProductsIndex;
use App\Http\Livewire\Admin\Providers\ProvidersIndex;
use App\Http\Livewire\Admin\Roles\RolesIndex;
use App\Http\Livewire\Admin\Sales\SalesIndex;
use App\Http\Livewire\Admin\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

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

/* Dashboard */
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

/* Companies */
Route::get('/companies', CompaniesIndex::class)
            ->name('admin.companies.index');

/* Branchofficces */
Route::get('/branchoffices', BranchofficesIndex::class)
            ->name('admin.branchoffices.index');

/* Users */
Route::get('/users', UsersIndex::class)
            ->name('admin.users.index');

/* Roles */
Route::get('/roles', RolesIndex::class)
            ->name('admin.roles.index');

/* Clients */
Route::get('/clients', ClientsIndex::class)
->name('admin.clients.index');

/* Providers */
Route::get('/providers', ProvidersIndex::class)
->name('admin.providers.index');

/* Brands */
Route::get('/brands', BrandsIndex::class)
->name('admin.brands.index');

/* Categories */
Route::get('/categories', CategoriesIndex::class)
            ->name('admin.categories.index');

/* Products */
Route::get('/products', ProductsIndex::class)
            ->name('admin.products.index');

/* CashRegisters */
Route::get('/cash-registers', CashRegistersIndex::class)
->name('admin.cash-registers.index');

/* CashOuts */
Route::get('/cashouts', CashoutsIndex::class)
->name('admin.cashouts.index');

/* Pos */
Route::get('/pos', Pos::class)
    ->name('admin.pos');
Route::get('/sale/print-ticket', function () {
    return view('livewire.admin.pos.ticket');
});

/* Sales */
Route::get('/sales', SalesIndex::class)
->name('admin.sales.index');

