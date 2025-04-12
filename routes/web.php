
<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ServiceController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});


  
    // Protect routes using authentication middleware
Route::middleware(['auth'])->group(function () {

    // Redirect users based on their role
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'agent') {
            return redirect()->route('agent.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return abort(403, 'Unauthorized Access');
        }
    })->name('dashboard');

    // Agent Dashboard
    Route::get('/agent/dashboard', function () {
        return view('agent.dashboard');
    })->name('agent.dashboard');

    // Customer Dashboard
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
   });

   Route::controller(ServiceController::class)->prefix('services')->group(function () {
    Route::get('', 'index')->name('services');
    Route::get('create', 'create')->name('services.create');
    Route::post('store', 'store')->name('services.store');
    Route::get('show/{id}', 'show')->name('services.show');
    Route::get('edit/{id}', 'edit')->name('services.edit');
    Route::put('edit/{id}', 'update')->name('services.update');
    Route::delete('destroy/{id}', 'destroy')->name('services.destroy');
});


    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    });
 
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');