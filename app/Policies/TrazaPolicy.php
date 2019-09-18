<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrazaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function listar (User $user) {
        if ($user->can('listar trazas')) {
            return true;
        }
        return false;
    }

    public function crear (User $user) {
        if ($user->can('crear trazas')) {
            return true;
        }
        return false;
    }

    public function exportar (User $user) {
        if ($user->can('exportar trazas')) {
            return true;
        }
        return false;
    }
}
