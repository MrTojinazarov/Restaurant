<?php

use App\Livewire\AdminComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\OrderComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', AdminComponent::class);
Route::get('/category', CategoryComponent::class);
Route::get('/food', FoodComponent::class);
Route::get('/order', OrderComponent::class);
