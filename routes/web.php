<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Orchid\Screens\ReferralSettingsScreen;

Route::get('/register', function () {
    return view('auth.register');
})->name('platform.register');

Route::post('/register', [RegisterController::class, 'register'])->name('platform.register.auth');

Route::screen('/referral/settings', ReferralSettingsScreen::class)
    ->name('platform.systems.settings');

Route::get('/', [HomeController::class, 'index'])
    ->name('platform.index')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Home'), route('platform.index')));

Route::get('/coin/{symbol}', [HomeController::class, 'coinDetail'])
    ->name('platform.coindetails')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Home'), route('platform.index')));

Route::get('/about', function () {
    return view('layout.about');
})
    ->name('platform.about')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('About'), route('platform.about')));

Route::get('/contact', function () {
    return view('layout.contact');
})
    ->name('platform.contact')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Contact'), route('platform.contact')));

Route::get('/markets', [HomeController::class, 'markets'])
    ->name('platform.markets')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Markets'), route('platform.markets')));

Route::get('/blog', function () {
    return view('layout.blog');
})
    ->name('platform.blog')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Blog'), route('platform.blog')));

Route::get('/faq', function () {
    return view('layout.faq');
})
    ->name('platform.faq')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('FAQ'), route('platform.faq')));

Route::get('/privacy', function () {
    return view('layout.privacy');
})
    ->name('platform.privacy')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Privacy'), route('platform.privacy')));

Route::get('/support', function () {
    return view('layout.support');
})
    ->name('platform.support')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Support'), route('platform.support')));

Route::get('/terms', function () {
    return view('layout.terms');
})
    ->name('platform.terms')
    ->breadcrumbs(fn($trail) => $trail
        ->push(__('Terms'), route('platform.terms')));

Route::get('/get-coins', [HomeController::class, 'getCoins'])
    ->name('platform.getcoins');

