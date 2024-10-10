<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', function () {
            return view('dashboard');
        });

    Route::get('/users/{user}', [MessageController::class, 'loadMessagesByUser'])->name('chat.user');
    Route::get('/groups/{group}', [MessageController::class, 'loadMessagesByGroup'])->name('chat.group');
});


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

