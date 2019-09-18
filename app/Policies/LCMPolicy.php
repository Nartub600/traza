<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LCMPolicy
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
        if ($user->can('listar lcms')) {
            return true;
        }
        return false;
    }

    public function crear (User $user) {
        if ($user->can('crear lcms')) {
            return true;
        }
        return false;
    }

    public function ver (User $user) {
        if ($user->can('ver lcms')) {
            return true;
        }
        return false;
    }

    public function editar (User $user) {
        if ($user->can('editar lcms')) {
            return true;
        }
        return false;
    }

    public function eliminar (User $user) {
        if ($user->can('eliminar lcms')) {
            return true;
        }
        return false;
    }
}
