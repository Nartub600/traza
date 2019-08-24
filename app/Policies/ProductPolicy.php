<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function listar(User $user)
    {
        if ($user->can('listar productos')) {
            return true;
        }
        return false;
    }

    public function crear(User $user)
    {
        if ($user->can('crear productos')) {
            return true;
        }
        return false;
    }

    public function ver(User $user)
    {
        if ($user->can('ver productos')) {
            return true;
        }
        return false;
    }

    public function editar(User $user)
    {
        if ($user->can('editar productos')) {
            return true;
        }
        return false;
    }

    public function eliminar(User $user)
    {
        if ($user->can('eliminar productos')) {
            return true;
        }
        return false;
    }

    public function exportar(User $user)
    {
        if ($user->can('exportar productos')) {
            return true;
        }
        return false;
    }

}
