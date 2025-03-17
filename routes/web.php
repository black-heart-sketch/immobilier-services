<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\FinanceCalculatorController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\TopographyController;
use App\Http\Controllers\BTPController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalogue des propriétés
Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/terrains', [PropertyController::class, 'index'])
         ->defaults('type', 'terrain')
         ->name('properties.terrains');
    Route::get('/maisons', [PropertyController::class, 'index'])
         ->defaults('type', 'maison')
         ->name('properties.maisons');
    Route::get('/map', [PropertyController::class, 'map'])->name('properties.map');
    Route::get('/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::post('/filter', [PropertyController::class, 'filter'])->name('properties.filter');
});

// Demandes de visite
Route::post('/visit-requests', [VisitRequestController::class, 'store'])->name('visit-requests.store');

// Simulateur de financement
Route::get('/finance-calculator', [FinanceCalculatorController::class, 'index'])->name('finance-calculator');
Route::post('/finance-calculator/calculate', [FinanceCalculatorController::class, 'calculate'])->name('finance-calculator.calculate');

// Chatbot
Route::post('/chatbot/message', [ChatbotController::class, 'handleMessage'])->name('chatbot.message');

// Topography Routes
Route::prefix('topography')->group(function () {
    Route::get('/', [TopographyController::class, 'index'])->name('topography.index');
    Route::post('/quote', [TopographyController::class, 'requestQuote'])->name('topography.quote');
});

// BTP Routes
Route::prefix('btp')->group(function () {
    Route::get('/', [BTPController::class, 'index'])->name('btp.index');
    Route::post('/calculate', [BTPController::class, 'calculateEstimate'])->name('btp.calculate');
    Route::post('/quote', [BTPController::class, 'requestQuote'])->name('btp.quote');
});

// Decoration Routes
Route::prefix('decoration')->group(function () {
    Route::get('/', [DecorationController::class, 'index'])->name('decoration.index');
    Route::get('/portfolio', [DecorationController::class, 'portfolio'])->name('decoration.portfolio');
    Route::get('/blog', [DecorationController::class, 'blog'])->name('decoration.blog');
    Route::get('/blog/{slug}', [DecorationController::class, 'article'])->name('decoration.article');
    Route::post('/consultation', [DecorationController::class, 'requestConsultation'])->name('decoration.consultation');
});

// Equipment Rental Routes
Route::prefix('equipment')->name('equipment.')->group(function () {
    Route::get('/', [EquipmentController::class, 'index'])->name('index');
    Route::get('/{equipment}', [EquipmentController::class, 'show'])->name('show');
    Route::post('/{equipment}/rent', [EquipmentController::class, 'rent'])->name('rent');
    Route::post('/{equipment}/maintenance', [EquipmentController::class, 'requestMaintenance'])->name('maintenance.request');
    Route::get('/rentals/{rental}/contract', [EquipmentController::class, 'downloadContract'])->name('rental.contract');
    Route::post('/rentals/{rental}/sign', [EquipmentController::class, 'signContract'])->name('rental.sign');
});

// Nursery Routes
Route::prefix('nursery')->name('nursery.')->group(function () {
    Route::get('/', [NurseryController::class, 'index'])->name('index');
    Route::get('/guide', [NurseryController::class, 'guide'])->name('guide');
    Route::get('/plants/{plant}', [NurseryController::class, 'show'])->name('show');
    Route::post('/quote', [NurseryController::class, 'requestQuote'])->name('quote');
});

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/{plant}', [CartController::class, 'add'])->name('add');
    Route::patch('/{cart}', [CartController::class, 'update'])->name('update');
    Route::delete('/{cart}', [CartController::class, 'remove'])->name('remove');
});

// Orders Routes (authenticated users only)
Route::middleware(['auth'])->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });
});

// Profile & Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    // Comment out middleware for development
    // ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/terrains', [AdminPropertyController::class, 'index'])->name('terrains');
        Route::get('/maisons', [AdminController::class, 'maisons'])->name('maisons');
        Route::get('/topographie', [AdminController::class, 'topographie'])->name('topographie');
        Route::get('/btp', [AdminController::class, 'btp'])->name('btp');
        Route::get('/decoration', [AdminController::class, 'decoration'])->name('decoration');
        Route::get('/location-engins', [AdminController::class, 'locationEngins'])->name('location-engins');
        Route::get('/pepinieres', [AdminController::class, 'pepinieres'])->name('pepinieres');
        Route::get('/account', [AdminController::class, 'account'])->name('account');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [AdminController::class, 'updatePassword'])->name('password.update');
    });
