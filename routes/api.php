<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartphoneController;

Route::apiResource('smartphones', SmartphoneController::class);
