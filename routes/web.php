<?php

use Illuminate\Support\Facades\Route;
use \Livewire\Volt\Volt;

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

Route::view('/', 'welcome');

Route::middleware('auth', 'verified')->group(function (){
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');

    Volt::route('/user', 'pages.user')->name('user.index');
    Volt::route('/member', 'pages.member')->name('member.index');
    Volt::route('/flower', 'pages.flower')->name('flower.index');
    Volt::route('/regency', 'pages.regency')->name('regency.index');
    Volt::route('/day', 'pages.day')->name('day.index');
});

require __DIR__.'/auth.php';
