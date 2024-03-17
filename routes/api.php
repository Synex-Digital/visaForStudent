<?php

use App\Http\Controllers\API\CountryAPIController;
use Illuminate\Support\Facades\Route;


//Country Information
Route::get('/country', [CountryAPIController::class, 'country']);
Route::get('/country/view/{slugs}', [CountryAPIController::class, 'countrySlugs']);
