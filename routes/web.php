<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VisaProcessingFormController;
use App\Http\Controllers\PageController; 
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail; 
use App\Http\Controllers\ProfileController;

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
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('create', 'create')->name('services.create');
    Route::post('store', 'store')->name('services.store');
    Route::get('show/{id}', 'show')->name('services.show');
    Route::get('edit/{id}', 'edit')->name('services.edit');
    Route::put('edit/{id}', 'update')->name('services.update');
    Route::delete('services/{services}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

Route::get('/', function () {
    return view('home');
});


Route::prefix('visa_processing')->group(function () {
    Route::get('/', [VisaProcessingFormController::class, 'index'])->name('visa_processing.index');
    Route::get('create', [VisaProcessingFormController::class, 'create'])->name('visa_processing.create');
    Route::post('store', [VisaProcessingFormController::class, 'store'])->name('visa_processing.store');
    Route::get('visa_processing/{id}', [VisaProcessingFormController::class, 'show'])->name('visa_processing.show');
    Route::get('edit/{visaProcessingForm}', [VisaProcessingFormController::class, 'edit'])->name('visa_processing.edit');
    Route::put('update/{visaProcessingForm}', [VisaProcessingFormController::class, 'update'])->name('visa_processing.update');
    Route::delete('visa-processing/{visaProcessingForm}', [VisaProcessingFormController::class, 'destroy'])->name('visa_processing.destroy');
    Route::get('visa-processing/download/{visaProcessingForm}', [VisaProcessingFormController::class, 'downloadPdf'])->name('visa_processing.download_pdf');
    //Route::post('/visa-approve/{id}', [VisaProcessingFormController::class, 'approve'])->name('visa.approve');
    Route::get('/test-approve/{id}', [VisaProcessingFormController::class, 'approve']);

});

    Route::get('/about', [PageController::class, 'about']);
  //  Route::get('/service', [PageController::class, 'services']);
    Route::post('/booking', [PageController::class, 'storeBooking']);
    Route::get('/contact', [PageController::class, 'contact']);

    Route::get('/test-mail', function () {
        $user = App\Models\User::first();  // Or use a test user
        Mail::to('test@example.com')->send(new TestMail($user));
        return 'Test email sent.';
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
 
   


  //  Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');