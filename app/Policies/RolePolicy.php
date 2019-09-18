<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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

    public function listar(User $user) {
        if ($user->can('listar perfiles')) {
            return true;
        }
        return false;
    }

    public function crear(User $user) {
        if ($user->can('crear perfiles')) {
            return true;
        }
        return false;
    }

    public function ver(User $user) {
        if ($user->can('ver perfiles')) {
            return true;
        }
        return false;
    }

    public function editar(User $user) {
        if ($user->can('editar perfiles')) {
            return true;
        }
        return false;
    }

    public function eliminar(User $user) {
        if ($user->can('eliminar perfiles')) {
            return true;
        }
        return false;
    }
}
