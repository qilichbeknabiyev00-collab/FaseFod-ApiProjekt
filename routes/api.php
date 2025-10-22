<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    // Foydalanuvchilar uchun (menu va buyurtma)
        Route::get('/dishes', [DishController::class, 'index']); // taomlarni ko‘rish
        Route::post('/orders', [OrderController::class, 'store']); // buyurtma yaratish
        Route::get('/my_orders', [OrderController::class, 'myOrders']); // buyurtmalarimni korish

    //Ofitsiant uchun
        Route::post('/dishes', [DishController::class, 'store']);
        Route::put('/dishes/{id}', [DishController::class, 'update']);
        Route::delete('/dishes/{id}', [DishController::class, 'destroy']);
        Route::get('/orders', [OrderController::class, 'index']); // buyurtmalarni ko‘rish
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']); // statusni o‘zgartirish

    // Admin uchun
        Route::get('/dishes', [DishController::class, 'index']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/users', [AuthController::class, 'listUsers']); // admin uchun qo‘shimcha

});
