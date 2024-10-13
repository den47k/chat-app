<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\CheckIfApproved;
use App\Livewire\ApproveUser;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', CheckIfApproved::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/users/{user}', [MessageController::class, 'loadMessagesByUser'])->name('chat.user');
    Route::get('/groups/{group}', [MessageController::class, 'loadMessagesByGroup'])->name('chat.group');
});

// Email verification and admin approval
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Not approved route
Route::get('/approve-notice', function () {
    return 'You are not approved by admin';
})->name('approval.notice');


// Admin route
Route::get('/admin', ApproveUser::class);


Route::get('/test', function () {
    // return dd([
    //     DB::table('groups')
    //         ->join('group_users', 'group_users.group_id', '=', 'groups.id')
    //         ->where('group_users.user_id', auth()->user()->id)
    //         ->get(),
    //     Group::getGroupsForUser(auth()->user())
    // ]);

    return dd(Conversation::getConversationsForSideBar(auth()->user()));
});

