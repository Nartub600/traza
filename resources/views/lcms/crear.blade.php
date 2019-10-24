@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('lcms.index') }}">LCMs</a></li>
    <li class="active">Nuevo</li>
  </ol>

  <h1>
    Nueva LCM
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('lcms.store') }}" method="post">
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
        <div class="w-1/2 form-group item-form px-4 relative @error('type') has-error @enderror">
          <label for="type" class="mb-4">Tipo de Licencia <sup>*</sup></label>
          <select required aria-required name="type" class="form-control" id="select-type">
            <option data-placeholder="true"></option>
            <option>Nueva</option>
            <option>Actualización Administrativa</option>
            <option>Actualización Técnica</option>
            <option>Extensión</option>
            <option>Renovación</option>
          </select>
          @error('type')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('defeats') has-error @enderror">
          <label for="defeats" class="mb-4">Anula y Reemplaza (Nº LCM)</label>
          <input type="text" name="defeats" class="form-control">
          @error('defeats')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('number') has-error @enderror">
          <label for="number" class="mb-4">Nº LCM <sup>*</sup></label>
          <input type="text" name="number" class="form-control" required aria-required>
          @error('number')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('issued_at') has-error @enderror">
          <label for="issued_at" class="mb-4">Fecha de emisión</label>
          <input type="date" name="issued_at" class="form-control">
          @error('issued_at')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('business_name') has-error @enderror">
          <label for="business_name" class="mb-4">Razón Social <sup>*</sup></label>
          <input type="text" name="business_name" class="form-control" required aria-required>
          @error('business_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('address') has-error @enderror">
          <label for="address" class="mb-4">Domicilio <sup>*</sup></label>
          <input type="text" name="address" class="form-control" required aria-required>
          @error('address')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('cuit') has-error @enderror">
          <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
          <input type="text" name="cuit" class="form-control" required aria-required>
          @error('cuit')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative @error('country') has-error @enderror">
          <label for="country" class="mb-4">País de Origen <sup>*</sup></label>
          <select class="form-control" name="country" required aria-required id="select-country">
            <option data-placeholder="true"></option>
            <option>Afganistán</option>
            <option>Albania</option>
            <option>Alemania</option>
            <option>Andorra</option>
            <option>Angola</option>
            <option>Antigua y Barbuda</option>
            <option>Arabia Saudita</option>
            <option>Argelia</option>
            <option>Argentina</option>
            <option>Armenia</option>
            <option>Australia</option>
            <option>Austria</option>
            <option>Azerbaiyán</option>
            <option>Bahamas</option>
            <option>Bangladés</option>
            <option>Barbados</option>
            <option>Baréin</option>
            <option>Bélgica</option>
            <option>Belice</option>
            <option>Benín</option>
            <option>Bielorrusia</option>
            <option>Birmania</option>
            <option>Bolivia</option>
            <option>Bosnia y Herzegovina</option>
            <option>Botsuana</option>
            <option>Brasil</option>
            <option>Brunéi</option>
            <option>Bulgaria</option>
            <option>Burkina Faso</option>
            <option>Burundi</option>
            <option>Bután</option>
            <option>Cabo Verde</option>
            <option>Camboya</option>
            <option>Camerún</option>
            <option>Canadá</option>
            <option>Catar</option>
            <option>Chad</option>
            <option>Chile</option>
            <option>China</option>
            <option>Chipre</option>
            <option>Ciudad del Vaticano</option>
            <option>Colombia</option>
            <option>Comoras</option>
            <option>Corea del Norte</option>
            <option>Corea del Sur</option>
            <option>Costa de Marfil</option>
            <option>Costa Rica</option>
            <option>Croacia</option>
            <option>Cuba</option>
            <option>Dinamarca</option>
            <option>Dominica</option>
            <option>Ecuador</option>
            <option>Egipto</option>
            <option>El Salvador</option>
            <option>Emiratos Árabes Unidos</option>
            <option>Eritrea</option>
            <option>Eslovaquia</option>
            <option>Eslovenia</option>
            <option>España</option>
            <option>Estados Unidos</option>
            <option>Estonia</option>
            <option>Etiopía</option>
            <option>Filipinas</option>
            <option>Finlandia</option>
            <option>Fiyi</option>
            <option>Francia</option>
            <option>Gabón</option>
            <option>Gambia</option>
            <option>Georgia</option>
            <option>Ghana</option>
            <option>Granada</option>
            <option>Grecia</option>
            <option>Guatemala</option>
            <option>Guyana</option>
            <option>Guinea</option>
            <option>Guinea-Bisáu</option>
            <option>Guinea Ecuatorial</option>
            <option>Haití</option>
            <option>Honduras</option>
            <option>Hungría</option>
            <option>India</option>
            <option>Indonesia</option>
            <option>Irak</option>
            <option>Irán</option>
            <option>Irlanda</option>
            <option>Islandia</option>
            <option>Islas Marshall</option>
            <option>Islas Salomón</option>
            <option>Israel</option>
            <option>Italia</option>
            <option>Jamaica</option>
            <option>Japón</option>
            <option>Jordania</option>
            <option>Kazajistán</option>
            <option>Kenia</option>
            <option>Kirguistán</option>
            <option>Kiribati</option>
            <option>Kuwait</option>
            <option>Laos</option>
            <option>Lesoto</option>
            <option>Letonia</option>
            <option>Líbano</option>
            <option>Liberia</option>
            <option>Libia</option>
            <option>Liechtenstein</option>
            <option>Lituania</option>
            <option>Luxemburgo</option>
            <option>Macedonia del Norte</option>
            <option>Madagascar</option>
            <option>Malasia</option>
            <option>Malaui</option>
            <option>Maldivas</option>
            <option>Malí</option>
            <option>Malta</option>
            <option>Marruecos</option>
            <option>Mauricio</option>
            <option>Mauritania</option>
            <option>México</option>
            <option>Micronesia</option>
            <option>Moldavia</option>
            <option>Mónaco</option>
            <option>Mongolia</option>
            <option>Montenegro</option>
            <option>Mozambique</option>
            <option>Namibia</option>
            <option>Nauru</option>
            <option>Nepal</option>
            <option>Nicaragua</option>
            <option>Níger</option>
            <option>Nigeria</option>
            <option>Noruega</option>
            <option>Nueva Zelanda</option>
            <option>Omán</option>
            <option>Países Bajos</option>
            <option>Pakistán</option>
            <option>Palaos</option>
            <option>Panamá</option>
            <option>Papúa Nueva Guinea</option>
            <option>Paraguay</option>
            <option>Perú</option>
            <option>Polonia</option>
            <option>Portugal</option>
            <option>Reino Unido de Gran Bretaña e Irlanda del Norte</option>
            <option>República Centroafricana</option>
            <option>República Checa</option>
            <option>República del Congo</option>
            <option>República Democrática del Congo</option>
            <option>República Dominicana</option>
            <option>República Sudafricana</option>
            <option>Ruanda</option>
            <option>Rumanía</option>
            <option>Rusia</option>
            <option>Samoa</option>
            <option>San Cristóbal y Nieves</option>
            <option>San Marino</option>
            <option>San Vicente y las Granadinas</option>
            <option>Santa Lucía</option>
            <option>Santo Tomé y Príncipe</option>
            <option>Senegal</option>
            <option>Serbia</option>
            <option>Seychelles</option>
            <option>Sierra Leona</option>
            <option>Singapur</option>
            <option>Siria</option>
            <option>Somalia</option>
            <option>Sri Lanka</option>
            <option>Suazilandia</option>
            <option>Sudán</option>
            <option>Sudán del Sur</option>
            <option>Suecia</option>
            <option>Suiza</option>
            <option>Surinam</option>
            <option>Tailandia</option>
            <option>Tanzania</option>
            <option>Tayikistán</option>
            <option>Timor Oriental</option>
            <option>Togo</option>
            <option>Tonga</option>
            <option>Trinidad y Tobago</option>
            <option>Túnez</option>
            <option>Turkmenistán</option>
            <option>Turquía</option>
            <option>Tuvalu</option>
            <option>Ucrania</option>
            <option>Uganda</option>
            <option>Uruguay</option>
            <option>Uzbekistán</option>
            <option>Vanuatu</option>
            <option>Venezuela</option>
            <option>Vietnam</option>
            <option>Yemen</option>
            <option>Yibuti</option>
            <option>Zambia</option>
            <option>Zimbabue</option>
          </select>
          @error('country')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('manufacturing_place') has-error @enderror">
          <label for="manufacturing_place" class="mb-4">Lugar de Fabricación</label>
          <input type="text" name="manufacturing_place" class="form-control">
          @error('manufacturing_place')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('commercial_name') has-error @enderror">
          <label for="commercial_name" class="mb-4">Denominación Comercial <sup>*</sup></label>
          <input type="text" name="commercial_name" class="form-control" required aria-required>
          @error('commercial_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('brand') has-error @enderror">
          <label for="brand" class="mb-4">Marca <sup>*</sup></label>
          <input type="text" name="brand" class="form-control" required aria-required>
          @error('brand')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('model') has-error @enderror">
          <label for="model" class="mb-4">Modelo <sup>*</sup></label>
          <input type="text" name="model" class="form-control" required aria-required>
          @error('model')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('category') has-error @enderror">
          <label for="category" class="mb-4">Categoría <sup>*</sup></label>
          <input type="text" name="category" class="form-control" required aria-required>
          @error('category')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('version') has-error @enderror">
          <label for="version" class="mb-4">Versión (Nro. VIN) <sup>*</sup></label>
          <input type="text" name="version" class="form-control" required aria-required>
          @error('version')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4 mb-0" href="{{ route('lcms.index') }}">
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

@push('scripts')
<script>
  IMask(document.querySelector('[name="cuit"]'), {
    mask: '00{-}000000[00]{-}0',
    lazy: false,
    placeholderChar: '#'
  })

  new SlimSelect({
    select: '#select-type',
    placeholder: 'Seleccione el tipo',
    searchPlaceholder: 'Buscar',
  })

  new SlimSelect({
    select: '#select-country',
    placeholder: 'Seleccione el origen',
    searchPlaceholder: 'Buscar',
  })
</script>
@endpush
