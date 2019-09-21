<?php

use Illuminate\Support\Facades\Route;
use Techouse\SelectAutoComplete\SelectAutoCompleteController;

/*
|--------------------------------------------------------------------------
| Field API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('/js/{asset}.js', SelectAutoCompleteController::class . '@jsAsset')
     ->name('select_auto_complete_js_asset');
Route::get('/css/{asset}.css', SelectAutoCompleteController::class . '@cssAsset')
     ->name('select_auto_complete_css_asset');