<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ApproveUser extends Component
{
    public function getNotApprovedUsersProperty() {
        return User::getNotApprovedUsers();
    }

    public function render()
    {
        return view('livewire.approve-user');
    }
}
