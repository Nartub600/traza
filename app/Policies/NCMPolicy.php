<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NCMPolicy
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
        if ($user->can('listar catalogo')) {
            return true;
        }
        return false;
    }

    public function crear(User $user)
    {
        if ($user->can('crear catalogo')) {
            return true;
        }
        return false;
    }

    public function ver(User $user)
    {
        if ($user->can('ver catalogo')) {
            return true;
        }
        return false;
    }

    public function editar(User $user)
    {
        if ($user->can('editar catalogo')) {
            return true;
        }
        return false;
    }

    public function eliminar(User $user)
    {
        if ($user->can('eliminar catalogo')) {
            return true;
        }
        return false;
    }

    public function exportar(User $user)
    {
        if ($user->can('exportar catalogo')) {
            return true;
        }
        return false;
    }
}
