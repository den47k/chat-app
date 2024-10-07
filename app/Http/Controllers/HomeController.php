<?php

namespace App\Http\Controllers;

use App\Models\Conversation;

class HomeController extends Controller
{
    public function index() {
        $conversations = Conversation::getConversationsForSideBar(auth()->user());

        return view('index', [
            'conversations' => $conversations,
        ]);
    }
}
