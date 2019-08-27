@extends('layouts.default')

@section('content')
<permisos
  :permissions="{{ $permissions }}"
  :old-permissions="{{ collect(old('permissions', [])) }}"
  :role="{{ $role }}"
  inline-template
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('perfiles.index') }}">Perfiles</a></li>
      <li class="active">Editar</li>
    </ol>

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

        <div class="flex flex-wrap -mx-4">
          <div class="w-1/2 form-group item-form px-4">
            <label for="name" class="mb-4">Nombre del perfil <sup>*</sup></label>
            <input type="text" name="name" class="form-control" required aria-required value="{{ old('name', $role->name) }}">
            <p class="help-block error hidden">Ingrese el nombre del perfil</p>
          </div>

          <div class="w-1/2 form-group item-form px-4">
            <label for="name" class="mb-4">Estado <sup>*</sup></label>
            <select name="active" class="form-control" value="{{ old('active', $role->active) }}">
              <option disabled value="">---</option>
              <option @if (old('active', $role->active) === true) selected @endif value="1">Activo</option>
              <option @if (old('active', $role->active) === false) selected @endif value="0">Inactivo</option>
            </select>
          </div>
        </div>

        <hr class="my-4">

        <template v-for="(grupo, grupoKey) in groupBy(permissions, 'grupo')">
          <div class="px-4" :grupo="grupoKey" :key="grupoKey">
            <div class="my-1 flex items-center">
              <button
                type="button"
                data-toggle="collapse"
                :data-target="`#${grupoKey.split(' ')[0]}`"
              >
                <i class="fa fa-chevron-down"></i>
              </button>
              <label
                class="capitalize flex items-center m-0 p-0 cursor-pointer"
                @click="toggleGroup(grupoKey)"
              >
                <button
                  type="button"
                  class="w-5 h-5 mr-2 border-2 border-azul border-solid rounded p-0 flex"
                  :class="[ permissions.filter(p => p.grupo === grupoKey).some(p => selectedPermissions.includes(p.id)) ? 'bg-azul' : 'bg-white' ]"
                >
                  <i
                    class="fa fa-check fa-fw text-white"
                    :class="[
                      permissions.filter(p => p.grupo === grupoKey).every(p => selectedPermissions.includes(p.id))
                      ? 'fa-check'
                      : ( permissions.filter(p => p.grupo === grupoKey).some(p => selectedPermissions.includes(p.id)) ? 'fa-minus' : '' )
                    ]"
                  >
                  </i>
                </button>
                <input class="appearance-none" type="checkbox">
                <span class="font-normal">@{{ grupoKey }}</span>
              </label>
            </div>
            <div class="collapse" :id="grupoKey.split(' ')[0]">
              <div class="flex">
                <div
                  v-if="permissions.filter(p => p.grupo === grupoKey).some(p => p.subgrupo)"
                  v-for="(subgrupo, subgrupoKey) in _.groupBy(permissions.filter(p => p.grupo === grupoKey), 'subgrupo')"
                  :key="subgrupoKey"
                  class="w-1/3"
                >
                  <div class="my-1 ml-12">
                    <label
                      class="capitalize flex items-center m-0 p-0 cursor-pointer"
                      @click="toggleSubgroup(subgrupoKey, grupoKey)"
                    >
                      <button
                        class="w-5 h-5 mr-2 border-2 border-azul border-solid rounded p-0 flex"
                        :class="[ permissions.filter(p => p.grupo === grupoKey).filter(p => p.subgrupo === subgrupoKey).some(p => selectedPermissions.includes(p.id)) ? 'bg-azul' : 'bg-white' ]"
                        type="button"
                      >
                        <i
                          class="fa fa-fw text-white"
                          :class="[
                            permissions.filter(p => p.grupo === grupoKey).filter(p => p.subgrupo === subgrupoKey).every(p => selectedPermissions.includes(p.id))
                            ? 'fa-check'
                            : ( permissions.filter(p => p.grupo === grupoKey).filter(p => p.subgrupo === subgrupoKey).some(p => selectedPermissions.includes(p.id)) ? 'fa-minus' : '' )
                          ]"
                        >
                        </i>
                      </button>
                      <input class="appearance-none" type="checkbox">
                      <span class="font-normal">@{{ subgrupoKey }}</span>
                    </label>
                    <div
                      v-for="permission in permissions.filter(p => p.grupo === grupoKey).filter(p => p.subgrupo === subgrupoKey)"
                      :key="permission.name"
                      class="my-2 ml-4"
                    >
                      <label
                        class="capitalize flex items-center m-0 p-0 cursor-pointer"
                        @click="toggle(permission.id)"
                      >
                        <button
                          class="w-5 h-5 mr-2 border-2 border-azul border-solid rounded p-0 flex"
                          :class="[ selectedPermissions.includes(permission.id) ? 'bg-azul' : 'bg-white' ]"
                          type="button"
                        >
                          <i
                            class="fa fa-check text-white"
                            :class="{ hidden: !selectedPermissions.includes(permission.id) }"
                          >
                          </i>
                        </button>
                        <input
                          class="appearance-none"
                          name="permissions[]"
                          type="checkbox"
                          :value="permission.id"
                          :checked="selectedPermissions.includes(permission.id)"
                        >
                        <span class="font-normal">@{{ permission.name }}</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div v-else class="w-1/3">
                  <div
                    v-for="permission in permissions.filter(p => p.grupo === grupoKey)"
                    :key="permission.name"
                    class="checkbox my-2 ml-12"
                  >
                    <label
                      class="capitalize flex items-center m-0 p-0 cursor-pointer"
                      @click="toggle(permission.id)"
                    >
                      <button
                        class="w-5 h-5 mr-2 border-2 border-azul border-solid rounded p-0 flex"
                        :class="[ selectedPermissions.includes(permission.id) ? 'bg-azul' : 'bg-white' ]"
                        type="button"
                      >
                        <i
                          class="fa fa-check text-white"
                          :class="{ hidden: !selectedPermissions.includes(permission.id) }"
                        >
                        </i>
                      </button>
                      <input
                        class="appearance-none"
                        name="permissions[]"
                        type="checkbox"
                        :value="permission.id"
                        :checked="selectedPermissions.includes(permission.id)"
                      >
                      <span>@{{ permission.name }}</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-4">
        </template>

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
</permisos>
@endsection
