@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <h1>
    Editar perfil <em>{{ $role->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('perfiles.update', $role->id) }}" method="post">
      @method('put')
      @csrf

      @if ($errors->any())
      <div class="alert alert-danger mx-3 mt-8">
        <h5>Se han producido los siguientes errores:</h5>
        <ol>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ol>
      </div>
      @endif

      <div class="form-group item-form px-4">
        <label for="name" class="mb-4">Nombre del perfil <sup>*</sup></label>
        <input type="text" name="name" class="form-control" required aria-required value="{{ $role->name }}">
        <p class="help-block error hidden">Ingrese el nombre del perfil</p>
      </div>

      <hr class="my-4">

      @foreach ($permissions->map->grupo->unique()->values() as $grupo)
      <div class="px-4 grupo">
        <div class="checkbox my-1">
          <label class="capitalize">
            <input type="checkbox">{{ $grupo }}
          </label>
        </div>
        <div class="flex">
          @if ($permissions->where('grupo', $grupo)->map->subgrupo->unique()->filter()->count())
            @foreach ($permissions->where('grupo', $grupo)->map->subgrupo->unique()->values() as $subgrupo)
              <div class="w-1/3 subgrupo">
                <div class="checkbox my-1 ml-3">
                  <label class="capitalize">
                    <input type="checkbox">{{ $subgrupo }}
                  </label>
                </div>
                <div>
                  @foreach ($permissions->where('grupo', $grupo)->where('subgrupo', $subgrupo) as $permission)
                  <div class="checkbox my-2 ml-6">
                    <label class="capitalize">
                      <input name="permissions[]" type="checkbox" value="{{ $permission->id }}" @if ($role->permissions->contains($permission)) checked @endif)>{{ $permission->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          @else
            <div class="w-1/3">
              @foreach ($permissions->where('grupo', $grupo) as $permission)
              <div class="checkbox my-2 ml-3">
                <label class="capitalize">
                  <input name="permissions[]" type="checkbox" value="{{ $permission->id }}" @if ($role->permissions->contains($permission)) checked @endif>{{ $permission->name }}
                </label>
              </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>

      <hr class="my-4">
      @endforeach

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('perfiles.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase mb-0" type="submit">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
