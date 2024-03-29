@extends('layouts.default')

@section('content')
<autopartes
  inline-template
  :old-autopartes="{{ collect(old('autoparts', [])) }}"
  :products="{{ $products }}"
  :ncm="{{ $ncm }}"
  autoparts-template="{{ asset('plantillas/autopartes.xlsx') }}"
>
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Inicio</a></li>
      <li><a href="{{ route('licencias.index') }}">Licencias</a></li>
      <li class="active">Nuevo</li>
    </ol>

    <h1>
      Nueva Licencia
    </h1>

    <hr class="my-4">

    <div class="bg-white p-4 mb-4" v-cloak>
      <form action="{{ route('licencias.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <template v-for="(autoparte, index) in autopartes">
          <input :key="`${index}-product_id`" type="hidden" :name="`autoparts[${index}][product_id]`" :value="autoparte.product_id">
          <input :key="`${index}-product_string`" type="hidden" :name="`autoparts[${index}][product_string]`" :value="autoparte.product_string">
          <input :key="`${index}-description`" type="hidden" :name="`autoparts[${index}][description]`" :value="autoparte.description">
          <input :key="`${index}-brand`" type="hidden" :name="`autoparts[${index}][brand]`" :value="autoparte.brand">
          <input :key="`${index}-model`" type="hidden" :name="`autoparts[${index}][model]`" :value="autoparte.model">
          <input :key="`${index}-origin`" type="hidden" :name="`autoparts[${index}][origin]`" :value="autoparte.origin">
          <input :key="`${index}-ncm_id`" type="hidden" :name="`autoparts[${index}][ncm_id]`" :value="autoparte.ncm_id">
          <input :key="`${index}-ncm_string`" type="hidden" :name="`autoparts[${index}][ncm_string]`" :value="autoparte.ncm_string">
          <input :key="`${index}-manufacturer`" type="hidden" :name="`autoparts[${index}][manufacturer]`" :value="autoparte.manufacturer">
          <input :key="`${index}-importer`" type="hidden" :name="`autoparts[${index}][importer]`" :value="autoparte.importer">
          <input :key="`${index}-business_name`" type="hidden" :name="`autoparts[${index}][business_name]`" :value="autoparte.business_name">
          <input :key="`${index}-part_number`" type="hidden" :name="`autoparts[${index}][part_number]`" :value="autoparte.part_number">
          <input :key="`${index}-size`" type="hidden" :name="`autoparts[${index}][size]`" :value="autoparte.size">
          <input :key="`${index}-formulation`" type="hidden" :name="`autoparts[${index}][formulation]`" :value="autoparte.formulation">
          <input :key="`${index}-application`" type="hidden" :name="`autoparts[${index}][application]`" :value="autoparte.application">
          <input :key="`${index}-license`" type="hidden" :name="`autoparts[${index}][license]`" :value="autoparte.license">
          <input :key="`${index}-certified_at`" type="hidden" :name="`autoparts[${index}][certified_at]`" :value="autoparte.certified_at">
        </template>

        @if ($errors->any())
        <div class="alert alert-danger mx-3 mt-8 w-1/2 mx-auto">
          <h5 class="text-center my-0">Se han producido errores</h5>
          @error('autoparts')
            <ul class="mt-2">
              <li>{{ $message }}</li>
            </ul>
          @enderror
        </div>
        @endif

        <div class="flex flex-wrap -mx-2">
          <div class="w-1/3 form-group item-form px-2 @error('number') has-error @enderror">
            <label for="number" class="mb-4">Número de licencia <sup>*</sup></label>
            <input type="text" name="number" class="form-control" required aria-required value="{{ old('number') }}">
            @error('number')
              <p class="help-block error">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/3 form-group item-form px-2 @error('cuit') has-error @enderror">
            <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
            <input type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit') }}">
            @error('cuit')
              <p class="help-block error">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-1/3 form-group item-form px-2 @error('documents[licencia]') has-error @enderror">
            <label for="documents[licencia]" class="mb-4">Licencia <sup>*</sup></label>
            <input type="file" name="documents[licencia]" class="form-control" accept="application/pdf">
            @error('documents[licencia]')
              <p class="help-block error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex justify-end -mx-2">
          <button
            type="button"
            class="btn btn-success uppercase mx-2"
            @click="add"
          >
            Agregar autoparte
          </button>

          <button type="button" class="btn btn-success uppercase mx-2" @click="beginAutopartsImport">
            Cargar Excel
          </button>
          <input
            action="{{ route('import.autoparts') }}"
            class="hidden"
            type="file"
            ref="excel"
            @change="handleAutopartsExcel"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
          >

          <button @click="clearIndex" type="button" class="btn btn-success uppercase mx-2">
            Vaciar listado
          </button>
        </div>

        <table class="table" id="tabla">
          <thead>
            <tr>
              <th>ORDEN</th>
              <th>PRODUCTO</th>
              <th>DESCRIPCIÓN</th>
              <th>MARCA</th>
              <th>MODELO</th>
              {{-- <th>FOTOS</th> --}}
              <th>ORIGEN</th>
              <th><i class="fa fa-cog"></i></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(autoparte, index) in autopartes">
              <td class="align-middle">@{{ index + 1 }}</td>
              <td class="align-middle">@{{ autoparte.product_string }}</td>
              <td class="align-middle">@{{ autoparte.description }}</td>
              <td class="align-middle">@{{ autoparte.brand }}</td>
              <td class="align-middle">@{{ autoparte.model }}</td>
              {{-- <td class="align-middle">
                <div class="swiper-container" :ref="`swiper${index}`">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="picture in autoparte.pictures">
                      <img class="w-64" :src="picture">
                    </div>
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
              </td> --}}
              <td class="align-middle">@{{ autoparte.origin }}</td>
              <td class="align-middle">
                <button type="button" @click="edit(autoparte, index)" class="btn text-azul m-0 p-0">
                  <i class="fa fa-edit"></i>
                </button>
                <button type="button" @click="removeFromIndex(index)" class="btn text-azul m-0 p-0">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="flex justify-end mt-4">
          <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('licencias.index') }}">
            Volver
          </a>

          <button class="btn btn-info uppercase mb-0" type="submit">
            Guardar
          </button>
        </div>
      </form>

      <autopartes-modal
        v-if="showModal"
        :products="flatProducts"
        :ncm="{{ $ncm }}"
        :countries="{{ $countries }}"
        :editing="editing"
        v-model="autoparte"
        @done="addToIndex"
      >
      </autopartes-modal>
    </div>
  </div>
</autopartes>
@endsection

@push('scripts')
<script>
  IMask(document.querySelector('[name="cuit"]'), {
    mask: '00{-}000000[00]{-}0',
    lazy: false,
    placeholderChar: '#'
  })
</script>
@endpush
