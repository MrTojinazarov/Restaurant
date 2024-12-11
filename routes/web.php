<?php

use App\Livewire\AdminComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\MealComponent;
use App\Livewire\OrderComponent;
use App\Livewire\OrderItemsComponent;
use App\Livewire\ParametrComponent;
use App\Livewire\SectionComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', AdminComponent::class);
Route::get('/category', CategoryComponent::class);
Route::get('/food', MealComponent::class);
Route::get('/order', OrderComponent::class)->name('order.home');
Route::get('/parametr/{categoryId}', ParametrComponent::class)->name('category.foods');
Route::get('/cart', CartComponent::class)->name('order.cart');
Route::get('/order-items', OrderItemsComponent::class);
Route::get('/section', SectionComponent::class);
