<?php

use App\Charts\MonthlyUsersChart;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard',[DashboardController::class, 'index'])
       ->middleware(['auth', 'verified'])
       ->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::get('about', function () {
        return Inertia::render('About');
        })->name('about');

    //  user
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('createuser', [UserController::class, 'create'])->name('users.create');
    Route::post('registeruser', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/{user}/reset', [UserController::class, 'reset'])->name('users.edit');

    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('officers', [UserController::class, 'officers'])->name('users.officers');

    //profile
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    //activity
    Route::get('activity', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('createactivity', [ActivityController::class, 'create'])->name('activity.create');
    Route::post('saveActivity', [ActivityController::class, 'store'])->name('activity.store');
    Route::get('activity/{activity}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
    Route::put('activity/{activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('activity/{activity}', [ActivityController::class, 'destroy'])->name('activity.destroy');
    Route::get('activity/{activity}/viewAttachment', [ActivityController::class, 'viewAttachment']);
    Route::get('activity/{activity}/viewComment', [ActivityController::class, 'viewComment']);
    Route::get('activity/{activity}/approvedByOrg', [ActivityController::class, 'approvedByOrg']);
    Route::get('activity/{activity}/approvedByDean', [ActivityController::class, 'approvedByDean']);

    Route::get('activity/{activity}/approvedByChancellor', [ActivityController::class, 'approvedByChancellor']);
    Route::get('schedule', [ActivityController::class, 'schedule'])->name('schedule');


    //PDF
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
    Route::get('activity/{activity}/PDF', [PDFController::class, 'activityPDF']);
    Route::get('generate-activity-report/{status}', [PDFController::class, 'activityReport'])->name('generate-activity-report');



    //signature
    Route::get('createSignature', [SignatureController::class, 'create'])->name('signature.create');
    Route::post('saveSignature', [SignatureController::class, 'store'])->name('signature.store');
    Route::get('signature', [SignatureController::class, 'index'])->name('signature.index');

    //comments
    Route::get('activity/{activity}/addComment', [CommentController::class, 'create'])->name('comment.create');
    Route::post('saveComment', [CommentController::class, 'store'])->name('comment.store');

    //organization
    Route::get('organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::put('organization/{organization}', [OrganizationController::class, 'create'])->name('organization.create');
    Route::get('createofficer', [OrganizationController::class, 'createOfficer'])->name('officers.create');
    Route::post('storeofficer', [OrganizationController::class, 'storeOfficer'])->name('officers.store');
    Route::get('officers/{user}/edit', [OrganizationController::class, 'editOfficer'])->name('officers.edit');
    Route::put('officers/{user}', [OrganizationController::class, 'updateOfficer'])->name('officers.update');
    Route::get('officers/{user}/createSignature', [OrganizationController::class, 'createSignature'])->name('officers.createSignature');
    Route::post('storeSignature/{user}', [OrganizationController::class, 'storeSignature'])->name('officers.storeSignature');
    Route::get('officers/{user}/updateSignature', [OrganizationController::class, 'updateSignature'])->name('officers.updateSignature');

    //chart
    Route::get('statistics', [ChartController::class, 'index'])->name('statistics');


    //rep
    Route::get('report', [ReportController::class, 'index'])->name('report.index');


});
require __DIR__ . '/auth.php';
