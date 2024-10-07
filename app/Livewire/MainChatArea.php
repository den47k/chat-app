<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;
use App\Events\SocketMessage;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreMessageRequest;

class MainChatArea extends Component
{
    // models to determine which messages to load
    public $user;
    public $group;

    // messages for conversations
    public $messages;

    // message that user sends
    public $messageInput;

    public function mount($user = null, $group = null, $messages)
    {
        if ($user) {
            $this->user = $user;
            $this->messages = $messages;
        } elseif ($group) {
            $this->group = $group;
            $this->messages = $messages;
        }
    }

    public function getListeners()
    {
        $user_id = auth()->id();

        $listeners = [
            "echo-private:message.user.{$user_id},SocketMessage" => 'userMessageSent',
        ];

        $userGroups = auth()->user()->groups;

        foreach ($userGroups as $group) {
            $listeners["echo-private:message.group.{$group->id},SocketMessage"] = 'groupMessageSent';
        }

        return $listeners;
    }

    public function userMessageSent($event)
    {
        $this->messages->push(Message::find($event['id']));
        $this->dispatch('scroll-bottom');
    }

    public function groupMessageSent($event)
    {
        $this->messages->push(Message::find($event['id']));
        $this->dispatch('scroll-bottom');
    }

    public function store()
    {
        // $this->validate();

        $newMessage = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->user->id ?? null,
            'group_id' => $this->group->id ?? null,
            'message' => $this->messageInput,
        ]);

        $this->messageInput = '';
        $this->messages->push($newMessage);
        $this->dispatch('scroll-bottom');

        SocketMessage::dispatch($newMessage);
    }

    // protected function rules() {
    //     return (new StoreMessageRequest())->rules();
    // }

    public function render()
    {
        return view('livewire.main-chat-area', [
            'messages' => $this->messages,
        ]);
    }
}
