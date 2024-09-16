<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Home";
});

Route::view("/teste", "teste");