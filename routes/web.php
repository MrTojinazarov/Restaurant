<!-- <?php ?> 
// use App\Livewire\AdminComponent;
// use App\Livewire\CartComponent;
// use App\Livewire\CategoryComponent;
// use App\Livewire\MealComponent;
// use App\Livewire\OrderComponent;
// use App\Livewire\OrderItemsComponent;
// use App\Livewire\ParametrComponent;
// use App\Livewire\RoleComponent;
// use App\Livewire\SectionComponent;
// use App\Livewire\UserComponent;
// use Illuminate\Support\Facades\Route;
// 
// Route::get('/', AdminComponent::class);
// Route::get('/category', CategoryComponent::class);
// Route::get('/food', MealComponent::class);
// Route::get('/order', OrderComponent::class)->name('order.home');
// Route::get('/parametr/{categoryId}', ParametrComponent::class)->name('category.foods');
// Route::get('/cart', CartComponent::class)->name('order.cart');
// Route::get('/order-items', OrderItemsComponent::class);
// Route::get('/section', SectionComponent::class);
// Route::get('/users', UserComponent::class);
// Route::get('/roles', RoleComponent::class);

<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserRole;
use App\Livewire\AdminComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\EmployeeComponent;
use App\Livewire\MealComponent;
use App\Livewire\OrderComponent;
use App\Livewire\OrderItemsComponent;
use App\Livewire\ParametrComponent;
use App\Livewire\RoleComponent;
use App\Livewire\SectionComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', AdminComponent::class)->name('main.page')->middleware(['auth', CheckUserRole::class . ':admin,waiter']);

Route::middleware(['auth', CheckUserRole::class . ':admin'])->group(function () {
    Route::get('/roles', RoleComponent::class);
    Route::get('/section', SectionComponent::class);
    Route::get('/employee', EmployeeComponent::class)->name('employee.page');
});

Route::middleware(['auth', CheckUserRole::class . ':manager,admin'])->group(function () {
    Route::get('/users', UserComponent::class);
    Route::get('/category', CategoryComponent::class);
    Route::get('/parametr/{categoryId}', ParametrComponent::class)->name('category.foods');
});

Route::middleware(['auth', CheckUserRole::class . ':waiter,admin'])->group(function () {
    Route::get('/food', MealComponent::class);
    Route::get('/order', OrderComponent::class)->name('order.home');
    Route::get('/cart', CartComponent::class)->name('order.cart');
    Route::get('/order-items', OrderItemsComponent::class);
});
