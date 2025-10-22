<?php

use App\Livewire\Products\Cart as ProductsCart;
use App\Livewire\Products\Catalogue;
use App\Livewire\Products\Checkout;
use App\Livewire\Products\Order;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\ShopView;
use App\Livewire\UsersManagement;
use App\Models\Cart;
use App\Models\Catalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    $products = Catalog::orderBy('updated_at', 'desc')->take(3)->get();
    return view('welcome',compact('products'));
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/shop', ShopView::class)->name('shop');
Route::middleware(['auth'])->group(function () {
    Route::get('/carts', ProductsCart::class);
    Route::get('/orders',Order::class);
    Route::get('/checkout',Checkout::class)->name('checkout');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('/products/catalogue', Catalogue::class)->name('products.catalogue');
    Route::get('/users',UsersManagement::class)->name('users.index');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
