<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StaffParcelController;
use App\Http\Controllers\StaffComplaintController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminEditStaffController;
use App\Http\Controllers\AdminController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('guest-home');
});

Auth::routes();

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// QR Code Generation Route
Route::get('/qr-code/{trackingId}', function ($trackingId) {
    try {
        $qrCode = QrCode::size(300)->generate($trackingId);
        return $qrCode;
    } catch (Exception $e) {
        Log::error($e->getMessage());
        // Or use dd($e->getMessage()) to display the error directly
    }
})->name('qr-code');

// Parcels routes
Route::resource('parcels', ParcelController::class);

// Complaints routes
Route::resource('complaints', ComplaintController::class)->only([
    'create', 'store', 'edit', 'update', 'destroy'
]);

Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');

Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');

Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

// User routes
Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
});

// Staff routes (accessible by supervisor, driver, and sorter)
Route::prefix('staff')->middleware(['auth', 'supervisor', 'driver', 'sorter'])->group(function () {
    Route::get('/home', function () {
        return view('staff.home');
    });

    Route::get('/parcels', [StaffParcelController::class, 'index'])->name('staff.parcels.index');
    Route::get('/parcels/create', [StaffParcelController::class, 'create'])->name('staff.parcels.create');
    Route::post('/parcels', [StaffParcelController::class, 'store'])->name('staff.parcels.store');
    Route::get('/parcels/{parcel}', [StaffParcelController::class, 'show'])->name('staff.parcels.show');
    Route::get('/parcels/{parcel}/edit', [StaffParcelController::class, 'edit'])->name('staff.parcels.edit');
    Route::put('/parcels/{parcel}', [StaffParcelController::class, 'update'])->name('staff.parcels.update');
    Route::delete('/parcels/{parcel}', [StaffParcelController::class, 'destroy'])->name('staff.parcels.destroy');

    Route::get('/complaints', [StaffComplaintController::class, 'index'])->name('staff.complaints.index');
    Route::get('/complaints/create', [StaffComplaintController::class, 'create'])->name('staff.complaints.create');
    Route::post('/complaints', [StaffComplaintController::class, 'store'])->name('staff.complaints.store');
    Route::get('/complaints/{complaint}', [StaffComplaintController::class, 'show'])->name('staff.complaints.show');
    Route::get('/complaints/{complaint}/edit', [StaffComplaintController::class, 'edit'])->name('staff.complaints.edit');
    Route::patch('/complaints/{complaint}', [StaffComplaintController::class, 'update'])->name('staff.complaints.update');
    Route::delete('/complaints/{complaint}', [StaffComplaintController::class, 'destroy'])->name('staff.complaints.destroy');

    Route::get('/scan-parcel', [ParcelController::class, 'scanPage'])->name('staff.scan.parcel');

});

// Staff list, edit, and delete routes (accessible by admin only)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/staff', [AdminEditStaffController::class, 'index'])->name('admin.staff.index');
    Route::get('/staff/{staff}/edit', [AdminEditStaffController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/staff/{staff}', [AdminEditStaffController::class, 'update'])->name('admin.staff.update');
    Route::delete('/staff/{staff}', [AdminEditStaffController::class, 'destroy'])->name('admin.staff.destroy');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/register/staff', [AdminController::class, 'registerStaff'])->name('admin.register.staff');
    Route::post('/register/staff', [AdminController::class, 'storeStaff'])->name('admin.store.staff');
});

Route::get('/user/unauthorized', function () {
    return view('user.unauthorized');
})->name('user.unauthorized');

Route::get('/staff/unauthorized', function () {
    return view('staff.unauthorized');
})->name('staff.unauthorized');

Route::get('/admin/unauthorized', function () {
    return view('admin.unauthorized');
})->name('admin.unauthorized');
