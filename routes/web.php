<?php

use App\Http\Controllers\admin\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminInstructorController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\frontend\FrontendDashboardController;
use App\Http\Controllers\LectureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');

    Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Profile & Password
        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('profile');
        Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
        Route::get('/settings', [AdminProfileController::class, 'settings'])->name('settings');
        Route::get('/password/settings', [AdminProfileController::class, 'showPasswordForm'])->name('passwordSettings');
        Route::post('/password/settings', [AdminProfileController::class, 'passwordSettings'])->name('passwordSettings.store');

        // Resource Management
        Route::resources([
            'category' => CategoryController::class,
            'subcategory' => SubCategoryController::class,
            'slider' => SliderController::class,
            'info' => InfoController::class,
            'instructor' => AdminInstructorController::class,
        ]);

        // Additional Instructor Management
        Route::post('/update-status', [AdminInstructorController::class, 'updateStatus'])->name('instructor.status');
        Route::get('/instructor-active-list', [AdminInstructorController::class, 'instructorActive'])->name('instructor.active');
    });
});

/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
*/
Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/login', [InstructorController::class, 'login'])->name('login');

    Route::middleware(['auth', 'role:instructor'])->group(function () {
        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [InstructorController::class, 'logout'])->name('logout');

        // Profile & Password
        Route::get('/profile', [InstructorProfileController::class, 'profile'])->name('profile');
        Route::post('/profile/store', [InstructorProfileController::class, 'store'])->name('profile.store');
        Route::get('/settings', [InstructorProfileController::class, 'settings'])->name('settings');
        Route::get('/password/settings', [InstructorProfileController::class, 'showPasswordForm'])->name('passwordSettings');
        Route::post('/password/settings', [InstructorProfileController::class, 'passwordSettings']);

        // Course Management
        Route::resources([
            'course' => CourseController::class,
            'course-section' => CourseSectionController::class,
            'lecture' => LectureController::class,
        ]);

        // Dynamic Subcategories
        Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories'])->name('get.subcategories');
    });
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [FrontendDashboardController::class, 'userDashboard'])->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendDashboardController::class, 'home'])->name('frontend.home');
Route::get('/course-details/{slug}', [FrontendDashboardController::class, 'courseDetails'])->name('frontend.course.details');

/*
|--------------------------------------------------------------------------
| Authenticated Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Auth Routes */
require __DIR__.'/auth.php';