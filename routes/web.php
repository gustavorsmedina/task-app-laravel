<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "authenticate"])->name("authenticate");

    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "store_user"])->name("store_user");
});

Route::middleware("auth")->group(function () {

    Route::get("/", [MainController::class, "home"])->name("home");
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    Route::post('/tasks', [TaskController::class, 'store_task'])->name('store_task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('delete_task');
    Route::post('/tasks/{task}/done', [TaskController::class, 'task_done'])->name('mark_task_done');
});
