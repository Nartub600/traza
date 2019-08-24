<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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
        if ($user->can('listar grupos')) {
            return true;
        }
        return false;
    }

    public function crear (User $user) {
        if ($user->can('crear grupos')) {
            return true;
        }
        return false;
    }

    public function ver (User $user) {
        if ($user->can('ver grupos')) {
            return true;
        }
        return false;
    }

    public function editar (User $user) {
        if ($user->can('editar grupos')) {
            return true;
        }
        return false;
    }

    public function eliminar (User $user) {
        if ($user->can('eliminar grupos')) {
            return true;
        }
        return false;
    }

}
