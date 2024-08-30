<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PurchaseOrderFormController;


//Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//User
Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/users/{id}', [UserController::class, 'getUser']);

//Test Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/purchaseorderforms", [PurchaseOrderFormController::class, 'getPurchaseOrderForms']);
    Route::get("/purchaseorderforms/{id}", [PurchaseOrderFormController::class, 'getPurchaseOrderForm']);
    Route::post("/purchaseorderform", [PurchaseOrderFormController::class, 'setPurchaseOrderForm']);
    Route::put("/purchaseorderform/{id}", [PurchaseOrderFormController::class, 'updatePurchaseOrderForm']);
    Route::delete("/purchaseorderform/{id}", [PurchaseOrderFormController::class, 'deletePurchaseOrderForm']);
    Route::put("/upload-image", [UploadController::class, 'uploadImage']);

    Route::post("/logout", [AuthController::class, 'logout']);
});