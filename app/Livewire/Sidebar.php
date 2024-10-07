<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;

class Sidebar extends Component
{

    public $onlineUsers = [];

    // Method to listen for presence channel events
    public function getListeners()
    {
        return [
            'echo-presence:online,here' => 'usersHere',
            'echo-presence:online,joining' => 'userJoining',
            'echo-presence:online,leaving' => 'userLeaving',
        ];
    }

    // Event when users are already present
    public function usersHere($users)
    {
        $this->onlineUsers = $users;
        $this->js("console.log('Online Users:', " . json_encode($users) . ")");
    }

    // Event when a user joins
    public function userJoining($user)
    {
        $this->onlineUsers[] = $user;
        $this->js("console.log('User Joinig:', " . json_encode($user) . ")");
    }

    // Event when a user leaves
    public function userLeaving($user)
    {
        $this->onlineUsers = array_filter($this->onlineUsers, function($onlineUser) use ($user) {
            return $onlineUser['id'] !== $user['id'];
        });
        $this->js("console.log('User Leaving:', " . json_encode($user) . ")");
    }


    // method to redirect user
    public function navigateToConversation($id, $is_user) {
        if ($is_user) {
            return $this->redirect(route('chat.user', $id), navigate: true);
        } else {
            return $this->redirect(route('chat.group', $id), navigate: true);
        }
    }


    // method to retreive all conversations
    public function getConversationsProperty()
    {
        return Conversation::getConversationsForSideBar(auth()->user());
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
