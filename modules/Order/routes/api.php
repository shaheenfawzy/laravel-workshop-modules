<?php

use Modules\Order\Http\Controllers\CreateOrderController;

Route::post('/orders', CreateOrderController::class)
    ->name('orders.create');