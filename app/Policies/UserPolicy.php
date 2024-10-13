<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function accessAdminPanel(User $user)
    {
        return $user->is_admin;
    }
}
