<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ReportController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// GET
Route::get('/', function () {
    return view('index');
});

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verify-email');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/signup', [AuthController::class, 'create'])->middleware('guest');
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify');
Route::get('/conditions', [ConditionController::class, 'index']);
Route::get('/conditions/{con_name}', [ConditionController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->get();
        return view('home', compact('posts'));
    })->name('home');
    Route::get('/additionals', function () {
        return view('auth.additionals');
    })->name('additionals');
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/edit', [UserController::class, 'edit']);
    Route::get('/reports/{user}/{type}/{id}', [ReportController::class, 'show']);
    Route::get('/journals', [PostController::class, 'index'])->name('journals');
    Route::get('/contents/{id}', [PostController::class, 'show']);
    Route::get('/community', [GroupController::class, 'index'])->name('community');
    Route::get('/reset-request/{email}', [PasswordResetController::class, 'showRequestForm'])->name('password-request');
    Route::get('/reset-request', [PasswordResetController::class, 'showRequestNull']);
    Route::get('password/reset/{email}/{token}', [PasswordResetController::class, 'showResetForm'])->name('password-reset');
});

// POST
Route::post('/store', [AuthController::class, 'store'])->name('store');
Route::post('/login-process', [AuthController::class, 'process']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/resend-verification-email', [AuthController::class, 'resendVerificationEmail'])->name('resend-verification-email');
Route::post('/post-store', [PostController::class, 'store']);
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments-store');
Route::post('/posts/{post}/comments/{comment}/reply', [CommentController::class, 'replyStore'])->name('comments-replyStore');
Route::post('/comments/{comment}/like', [CommentController::class, 'likeComment'])->name('comments-like');
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password-email');
Route::post('/report', [ReportController::class, 'store'])->name('report-store');

// PUT
Route::put('/update-post-status/{id}', [PostController::class, 'updateStatus'])->name('posts-updateStatus');
Route::put('/update-profile', [UserController::class, 'update'])->name('update-profile');
Route::put('/password-update', [PasswordResetController::class, 'reset'])->name('password-update');

// DELETE
Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('post-delete');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments-destroy');
Route::delete('/replies/{reply}', [CommentController::class, 'replyDestroy'])->name('replies-destroy');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
    Route::get('/user-management', [AdminController::class, 'user'])->name('user-list');
    Route::get('/contents-management', [AdminController::class, 'contents']);
    Route::get('/filed-reports', [AdminController::class, 'filedreports']);
    Route::get('/manage-events', [AdminController::class, 'events'])->name('manage-events');
    Route::get('/update-user/{id}', [AdminController::class, 'update']);
    Route::get('/add-user', [AdminController::class, 'adduser']);
    Route::get('/comments-management', [AdminController::class, 'comments']);
    Route::get('/view-post/{id}', [AdminController::class, 'viewpost']);
    Route::get('/view-comment/{id}', [AdminController::class, 'viewcomment']);
    Route::get('/event-details/{id}', [AdminController::class, 'event']);
    Route::get('/add-event', [AdminController::class, 'addevent']);
    Route::get('/manage-conditions', [AdminController::class, 'condition'])->name('manage-conditions');
    Route::get('/add-condition', [AdminController::class, 'formCondition']);
    Route::get('/condition-details/{id}', [AdminController::class, 'editCondition']);

    Route::post('/adding-user', [AdminController::class, 'store']);
    Route::post('/save-event', [AdminController::class, 'new']);
    Route::post('/save-condition', [AdminController::class, 'newcondition']);

    Route::put('/updating', [AdminController::class, 'patch']);
    Route::put('/save-changes', [AdminController::class, 'change']);
    Route::put('/savechange', [AdminController::class, 'updatecon']);

    Route::delete('/delete-User', [AdminController::class, 'destroy']);
    Route::delete('/delete-Post', [AdminController::class, 'destroypost']);
    Route::delete('/delete-Comment', [AdminController::class, 'destroycomment']);
    Route::delete('/delete-Report', [AdminController::class, 'destroyreport']);
    Route::delete('/delete-Event', [AdminController::class, 'destroyevent']);
    Route::delete('/delete-Condition', [AdminController::class, 'destroycondition']);
});
