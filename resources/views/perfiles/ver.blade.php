@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <h1>
    Ver perfil <em>{{ $role->name }}</em>
  </h1>

  <hr class="my-4">

  <div class="form-group item-form px-4">
    <label for="name" class="mb-4">Nombre del perfil <sup>*</sup></label>
    <input type="text" name="name" class="form-control" readonly value="{{ $role->name }}">
  </div>

  <hr class="my-4">

  <div class="bg-white px-8 py-4 mx-4 mb-4">
    @foreach ($role->permissions->map->grupo->unique()->values() as $grupo)
    <div class="grupo">
      <p class="capitalize">
        {{ $grupo }}
      </p>
      <div class="flex">
        @if ($role->permissions->where('grupo', $grupo)->map->subgrupo->unique()->filter()->count())
          @foreach ($role->permissions->where('grupo', $grupo)->map->subgrupo->unique()->values() as $subgrupo)
            <div class="w-1/3 subgrupo">
              <p class="capitalize ml-3">
                {{ $subgrupo }}
              </p>
              <div>
                @foreach ($role->permissions->where('grupo', $grupo)->where('subgrupo', $subgrupo) as $permission)
                <p class="capitalize ml-6">
                  {{ $permission->name }}
                </p>
                @endforeach
              </div>
            </div>
          @endforeach
        @else
          <div class="w-1/3">
            @foreach ($role->permissions->where('grupo', $grupo) as $permission)
            <p class="capitalize ml-3">
              {{ $permission->name }}
            </p>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <hr class="my-4">
    @endforeach

    <div class="flex justify-end">
      <a class="btn btn-success uppercase mb-0" href="{{ route('perfiles.index') }}">
        Volver
      </a>
    </div>
  </div>
</div>
@endsection
