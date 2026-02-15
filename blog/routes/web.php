<?php

use Illuminate\Support\Facades\Route;

Route::get('/articles', function() {
    return "Article List";
});

Route::get('/articles/detail/{id}', function ($id) {
    return "Article Detail $id";
});

Route::get('/', function () {
    return view('welcome');
});
