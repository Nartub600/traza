<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificatePolicy
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
        if ($user->can('listar licencias')) {
            return true;
        }
        return false;
    }

    public function crear(User $user)
    {
        if ($user->can('crear licencias')) {
            return true;
        }
        return false;
    }

    public function ver(User $user)
    {
        if ($user->can('ver licencias')) {
            return true;
        }
        return false;
    }

    public function editar(User $user)
    {
        if ($user->can('editar licencias')) {
            return true;
        }
        return false;
    }

    public function eliminar(User $user)
    {
        if ($user->can('eliminar licencias')) {
            return true;
        }
        return false;
    }

    public function exportar(User $user)
    {
        if ($user->can('exportar licencias')) {
            return true;
        }
        return false;
    }
}
