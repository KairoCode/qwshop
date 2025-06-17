<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', [App\CloudErp\Controllers\SpaController::class,'index'])->where('any', '.*');
