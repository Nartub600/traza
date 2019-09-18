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
        if ($user->can('listar certificados')) {
            return true;
        }
        return false;
    }

    public function crear(User $user)
    {
        if ($user->can('crear certificados')) {
            return true;
        }
        return false;
    }

    public function ver(User $user)
    {
        if ($user->can('ver certificados')) {
            return true;
        }
        return false;
    }

    public function editar(User $user)
    {
        if ($user->can('editar certificados')) {
            return true;
        }
        return false;
    }

    public function eliminar(User $user)
    {
        if ($user->can('eliminar certificados')) {
            return true;
        }
        return false;
    }

    public function exportar(User $user)
    {
        if ($user->can('exportar certificados')) {
            return true;
        }
        return false;
    }
}
