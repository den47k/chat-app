<?php

namespace App\Http\Controllers;

use App\Events\SocketMessage;
use App\Http\Requests\StoreMessageRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\Message;

class MessageController extends Controller
{
    public function loadMessagesByUser(User $user) {

        $messages = Message::where(function ($query) use ($user) {
            $query
                ->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id)
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', auth()->id());
                });
        })
            ->with('sender')
            ->latest()
            ->take(10)
            ->get()
            ->reverse();

        return view('index', [
            'user' => $user,
            'group' => null,
            'messages' => $messages
        ]);
    }

    public function loadMessagesByGroup(Group $group) {

        $messages = Message::where('group_id', $group->id)
            ->with('sender')
            ->latest()
            ->take(10)
            ->get()
            ->reverse();

        return view('index', [
            'user' => null,
            'group' => $group,
            'messages' => $messages
        ]);
    }

    public function loadOlder(Message $message) {

    }

    public function store(StoreMessageRequest $request) {
    }

    public function destroy(Message $message) {

    }
}
