<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
* Dashboard is prefixed by default
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); 

require __DIR__ . '/support.php';
require __DIR__ . '/report.php';
require __DIR__ . '/release.php';
require __DIR__ . '/product.php';
require __DIR__ . '/invitation.php';
require __DIR__ . '/document.php';
require __DIR__ . '/idea.php';
require __DIR__ . '/task.php';