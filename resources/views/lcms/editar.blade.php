@extends('layouts.default')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('lcms.index') }}">LCMs</a></li>
    <li class="active">Editar</li>
  </ol>

  <h1>
    Editar LCM <em>{{ $lcm->gde }}</em>
  </h1>

  <hr class="my-4">

  <div class="bg-white p-4 mb-4">
    <form action="{{ route('lcms.update', $lcm->id) }}" method="post">
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
        <div class="w-1/2 form-group item-form px-4 @error('type') has-error @enderror">
          <label for="type" class="mb-4">Tipo de Licencia <sup>*</sup></label>
          <input type="text" name="type" class="form-control" required aria-required value="{{ old('type', $lcm->type) }}">
          @error('type')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('defeats') has-error @enderror">
          <label for="defeats" class="mb-4">Anula y Reemplaza (Nº LCM) <sup>*</sup></label>
          <input type="text" name="defeats" class="form-control" required aria-required value="{{ old('defeats', $lcm->defeats) }}">
          @error('defeats')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('number') has-error @enderror">
          <label for="number" class="mb-4">Nº LCM <sup>*</sup></label>
          <input type="text" name="number" class="form-control" required aria-required value="{{ old('number', $lcm->number) }}">
          @error('number')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('issued_at') has-error @enderror">
          <label for="issued_at" class="mb-4">Fecha de emisión <sup>*</sup></label>
          <input type="text" name="issued_at" class="form-control" required aria-required value="{{ old('issued_at', $lcm->issued_at) }}">
          @error('issued_at')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('business_name') has-error @enderror">
          <label for="business_name" class="mb-4">Razón Social <sup>*</sup></label>
          <input type="text" name="business_name" class="form-control" required aria-required value="{{ old('business_name', $lcm->business_name) }}">
          @error('business_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('address') has-error @enderror">
          <label for="address" class="mb-4">Domicilio <sup>*</sup></label>
          <input type="text" name="address" class="form-control" required aria-required value="{{ old('address', $lcm->address) }}">
          @error('address')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('cuit') has-error @enderror">
          <label for="cuit" class="mb-4">CUIT <sup>*</sup></label>
          <input type="text" name="cuit" class="form-control" required aria-required value="{{ old('cuit', $lcm->cuit) }}">
          @error('cuit')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 relative @error('country') has-error @enderror">
          <label for="country" class="mb-4">País de Origen <sup>*</sup></label>
          <input type="text" name="country" class="form-control" required aria-required value="{{ old('country', $lcm->country) }}">
          <select class="form-control" name="origin" required aria-required id="select-origin">
            <option data-placeholder="true"></option>
            <option @if (old('origin', $lcm->origin) === "Afganistán") selected @endif>Afganistán</option>
            <option @if (old('origin', $lcm->origin) === "Albania") selected @endif>Albania</option>
            <option @if (old('origin', $lcm->origin) === "Alemania") selected @endif>Alemania</option>
            <option @if (old('origin', $lcm->origin) === "Andorra") selected @endif>Andorra</option>
            <option @if (old('origin', $lcm->origin) === "Angola") selected @endif>Angola</option>
            <option @if (old('origin', $lcm->origin) === "Antigua y Barbuda") selected @endif>Antigua y Barbuda</option>
            <option @if (old('origin', $lcm->origin) === "Arabia Saudita") selected @endif>Arabia Saudita</option>
            <option @if (old('origin', $lcm->origin) === "Argelia") selected @endif>Argelia</option>
            <option @if (old('origin', $lcm->origin) === "Argentina") selected @endif>Argentina</option>
            <option @if (old('origin', $lcm->origin) === "Armenia") selected @endif>Armenia</option>
            <option @if (old('origin', $lcm->origin) === "Australia") selected @endif>Australia</option>
            <option @if (old('origin', $lcm->origin) === "Austria") selected @endif>Austria</option>
            <option @if (old('origin', $lcm->origin) === "Azerbaiyán") selected @endif>Azerbaiyán</option>
            <option @if (old('origin', $lcm->origin) === "Bahamas") selected @endif>Bahamas</option>
            <option @if (old('origin', $lcm->origin) === "Bangladés") selected @endif>Bangladés</option>
            <option @if (old('origin', $lcm->origin) === "Barbados") selected @endif>Barbados</option>
            <option @if (old('origin', $lcm->origin) === "Baréin") selected @endif>Baréin</option>
            <option @if (old('origin', $lcm->origin) === "Bélgica") selected @endif>Bélgica</option>
            <option @if (old('origin', $lcm->origin) === "Belice") selected @endif>Belice</option>
            <option @if (old('origin', $lcm->origin) === "Benín") selected @endif>Benín</option>
            <option @if (old('origin', $lcm->origin) === "Bielorrusia") selected @endif>Bielorrusia</option>
            <option @if (old('origin', $lcm->origin) === "Birmania") selected @endif>Birmania</option>
            <option @if (old('origin', $lcm->origin) === "Bolivia") selected @endif>Bolivia</option>
            <option @if (old('origin', $lcm->origin) === "Bosnia y Herzegovina") selected @endif>Bosnia y Herzegovina</option>
            <option @if (old('origin', $lcm->origin) === "Botsuana") selected @endif>Botsuana</option>
            <option @if (old('origin', $lcm->origin) === "Brasil") selected @endif>Brasil</option>
            <option @if (old('origin', $lcm->origin) === "Brunéi") selected @endif>Brunéi</option>
            <option @if (old('origin', $lcm->origin) === "Bulgaria") selected @endif>Bulgaria</option>
            <option @if (old('origin', $lcm->origin) === "Burkina Faso") selected @endif>Burkina Faso</option>
            <option @if (old('origin', $lcm->origin) === "Burundi") selected @endif>Burundi</option>
            <option @if (old('origin', $lcm->origin) === "Bután") selected @endif>Bután</option>
            <option @if (old('origin', $lcm->origin) === "Cabo Verde") selected @endif>Cabo Verde</option>
            <option @if (old('origin', $lcm->origin) === "Camboya") selected @endif>Camboya</option>
            <option @if (old('origin', $lcm->origin) === "Camerún") selected @endif>Camerún</option>
            <option @if (old('origin', $lcm->origin) === "Canadá") selected @endif>Canadá</option>
            <option @if (old('origin', $lcm->origin) === "Catar") selected @endif>Catar</option>
            <option @if (old('origin', $lcm->origin) === "Chad") selected @endif>Chad</option>
            <option @if (old('origin', $lcm->origin) === "Chile") selected @endif>Chile</option>
            <option @if (old('origin', $lcm->origin) === "China") selected @endif>China</option>
            <option @if (old('origin', $lcm->origin) === "Chipre") selected @endif>Chipre</option>
            <option @if (old('origin', $lcm->origin) === "Ciudad del Vaticano") selected @endif>Ciudad del Vaticano</option>
            <option @if (old('origin', $lcm->origin) === "Colombia") selected @endif>Colombia</option>
            <option @if (old('origin', $lcm->origin) === "Comoras") selected @endif>Comoras</option>
            <option @if (old('origin', $lcm->origin) === "Corea del Norte") selected @endif>Corea del Norte</option>
            <option @if (old('origin', $lcm->origin) === "Corea del Sur") selected @endif>Corea del Sur</option>
            <option @if (old('origin', $lcm->origin) === "Costa de Marfil") selected @endif>Costa de Marfil</option>
            <option @if (old('origin', $lcm->origin) === "Costa Rica") selected @endif>Costa Rica</option>
            <option @if (old('origin', $lcm->origin) === "Croacia") selected @endif>Croacia</option>
            <option @if (old('origin', $lcm->origin) === "Cuba") selected @endif>Cuba</option>
            <option @if (old('origin', $lcm->origin) === "Dinamarca") selected @endif>Dinamarca</option>
            <option @if (old('origin', $lcm->origin) === "Dominica") selected @endif>Dominica</option>
            <option @if (old('origin', $lcm->origin) === "Ecuador") selected @endif>Ecuador</option>
            <option @if (old('origin', $lcm->origin) === "Egipto") selected @endif>Egipto</option>
            <option @if (old('origin', $lcm->origin) === "El Salvador") selected @endif>El Salvador</option>
            <option @if (old('origin', $lcm->origin) === "Emiratos Árabes Unidos") selected @endif>Emiratos Árabes Unidos</option>
            <option @if (old('origin', $lcm->origin) === "Eritrea") selected @endif>Eritrea</option>
            <option @if (old('origin', $lcm->origin) === "Eslovaquia") selected @endif>Eslovaquia</option>
            <option @if (old('origin', $lcm->origin) === "Eslovenia") selected @endif>Eslovenia</option>
            <option @if (old('origin', $lcm->origin) === "España") selected @endif>España</option>
            <option @if (old('origin', $lcm->origin) === "Estados Unidos") selected @endif>Estados Unidos</option>
            <option @if (old('origin', $lcm->origin) === "Estonia") selected @endif>Estonia</option>
            <option @if (old('origin', $lcm->origin) === "Etiopía") selected @endif>Etiopía</option>
            <option @if (old('origin', $lcm->origin) === "Filipinas") selected @endif>Filipinas</option>
            <option @if (old('origin', $lcm->origin) === "Finlandia") selected @endif>Finlandia</option>
            <option @if (old('origin', $lcm->origin) === "Fiyi") selected @endif>Fiyi</option>
            <option @if (old('origin', $lcm->origin) === "Francia") selected @endif>Francia</option>
            <option @if (old('origin', $lcm->origin) === "Gabón") selected @endif>Gabón</option>
            <option @if (old('origin', $lcm->origin) === "Gambia") selected @endif>Gambia</option>
            <option @if (old('origin', $lcm->origin) === "Georgia") selected @endif>Georgia</option>
            <option @if (old('origin', $lcm->origin) === "Ghana") selected @endif>Ghana</option>
            <option @if (old('origin', $lcm->origin) === "Granada") selected @endif>Granada</option>
            <option @if (old('origin', $lcm->origin) === "Grecia") selected @endif>Grecia</option>
            <option @if (old('origin', $lcm->origin) === "Guatemala") selected @endif>Guatemala</option>
            <option @if (old('origin', $lcm->origin) === "Guyana") selected @endif>Guyana</option>
            <option @if (old('origin', $lcm->origin) === "Guinea") selected @endif>Guinea</option>
            <option @if (old('origin', $lcm->origin) === "Guinea-Bisáu") selected @endif>Guinea-Bisáu</option>
            <option @if (old('origin', $lcm->origin) === "Guinea Ecuatorial") selected @endif>Guinea Ecuatorial</option>
            <option @if (old('origin', $lcm->origin) === "Haití") selected @endif>Haití</option>
            <option @if (old('origin', $lcm->origin) === "Honduras") selected @endif>Honduras</option>
            <option @if (old('origin', $lcm->origin) === "Hungría") selected @endif>Hungría</option>
            <option @if (old('origin', $lcm->origin) === "India") selected @endif>India</option>
            <option @if (old('origin', $lcm->origin) === "Indonesia") selected @endif>Indonesia</option>
            <option @if (old('origin', $lcm->origin) === "Irak") selected @endif>Irak</option>
            <option @if (old('origin', $lcm->origin) === "Irán") selected @endif>Irán</option>
            <option @if (old('origin', $lcm->origin) === "Irlanda") selected @endif>Irlanda</option>
            <option @if (old('origin', $lcm->origin) === "Islandia") selected @endif>Islandia</option>
            <option @if (old('origin', $lcm->origin) === "Islas Marshall") selected @endif>Islas Marshall</option>
            <option @if (old('origin', $lcm->origin) === "Islas Salomón") selected @endif>Islas Salomón</option>
            <option @if (old('origin', $lcm->origin) === "Israel") selected @endif>Israel</option>
            <option @if (old('origin', $lcm->origin) === "Italia") selected @endif>Italia</option>
            <option @if (old('origin', $lcm->origin) === "Jamaica") selected @endif>Jamaica</option>
            <option @if (old('origin', $lcm->origin) === "Japón") selected @endif>Japón</option>
            <option @if (old('origin', $lcm->origin) === "Jordania") selected @endif>Jordania</option>
            <option @if (old('origin', $lcm->origin) === "Kazajistán") selected @endif>Kazajistán</option>
            <option @if (old('origin', $lcm->origin) === "Kenia") selected @endif>Kenia</option>
            <option @if (old('origin', $lcm->origin) === "Kirguistán") selected @endif>Kirguistán</option>
            <option @if (old('origin', $lcm->origin) === "Kiribati") selected @endif>Kiribati</option>
            <option @if (old('origin', $lcm->origin) === "Kuwait") selected @endif>Kuwait</option>
            <option @if (old('origin', $lcm->origin) === "Laos") selected @endif>Laos</option>
            <option @if (old('origin', $lcm->origin) === "Lesoto") selected @endif>Lesoto</option>
            <option @if (old('origin', $lcm->origin) === "Letonia") selected @endif>Letonia</option>
            <option @if (old('origin', $lcm->origin) === "Líbano") selected @endif>Líbano</option>
            <option @if (old('origin', $lcm->origin) === "Liberia") selected @endif>Liberia</option>
            <option @if (old('origin', $lcm->origin) === "Libia") selected @endif>Libia</option>
            <option @if (old('origin', $lcm->origin) === "Liechtenstein") selected @endif>Liechtenstein</option>
            <option @if (old('origin', $lcm->origin) === "Lituania") selected @endif>Lituania</option>
            <option @if (old('origin', $lcm->origin) === "Luxemburgo") selected @endif>Luxemburgo</option>
            <option @if (old('origin', $lcm->origin) === "Macedonia del Norte") selected @endif>Macedonia del Norte</option>
            <option @if (old('origin', $lcm->origin) === "Madagascar") selected @endif>Madagascar</option>
            <option @if (old('origin', $lcm->origin) === "Malasia") selected @endif>Malasia</option>
            <option @if (old('origin', $lcm->origin) === "Malaui") selected @endif>Malaui</option>
            <option @if (old('origin', $lcm->origin) === "Maldivas") selected @endif>Maldivas</option>
            <option @if (old('origin', $lcm->origin) === "Malí") selected @endif>Malí</option>
            <option @if (old('origin', $lcm->origin) === "Malta") selected @endif>Malta</option>
            <option @if (old('origin', $lcm->origin) === "Marruecos") selected @endif>Marruecos</option>
            <option @if (old('origin', $lcm->origin) === "Mauricio") selected @endif>Mauricio</option>
            <option @if (old('origin', $lcm->origin) === "Mauritania") selected @endif>Mauritania</option>
            <option @if (old('origin', $lcm->origin) === "México") selected @endif>México</option>
            <option @if (old('origin', $lcm->origin) === "Micronesia") selected @endif>Micronesia</option>
            <option @if (old('origin', $lcm->origin) === "Moldavia") selected @endif>Moldavia</option>
            <option @if (old('origin', $lcm->origin) === "Mónaco") selected @endif>Mónaco</option>
            <option @if (old('origin', $lcm->origin) === "Mongolia") selected @endif>Mongolia</option>
            <option @if (old('origin', $lcm->origin) === "Montenegro") selected @endif>Montenegro</option>
            <option @if (old('origin', $lcm->origin) === "Mozambique") selected @endif>Mozambique</option>
            <option @if (old('origin', $lcm->origin) === "Namibia") selected @endif>Namibia</option>
            <option @if (old('origin', $lcm->origin) === "Nauru") selected @endif>Nauru</option>
            <option @if (old('origin', $lcm->origin) === "Nepal") selected @endif>Nepal</option>
            <option @if (old('origin', $lcm->origin) === "Nicaragua") selected @endif>Nicaragua</option>
            <option @if (old('origin', $lcm->origin) === "Níger") selected @endif>Níger</option>
            <option @if (old('origin', $lcm->origin) === "Nigeria") selected @endif>Nigeria</option>
            <option @if (old('origin', $lcm->origin) === "Noruega") selected @endif>Noruega</option>
            <option @if (old('origin', $lcm->origin) === "Nueva Zelanda") selected @endif>Nueva Zelanda</option>
            <option @if (old('origin', $lcm->origin) === "Omán") selected @endif>Omán</option>
            <option @if (old('origin', $lcm->origin) === "Países Bajos") selected @endif>Países Bajos</option>
            <option @if (old('origin', $lcm->origin) === "Pakistán") selected @endif>Pakistán</option>
            <option @if (old('origin', $lcm->origin) === "Palaos") selected @endif>Palaos</option>
            <option @if (old('origin', $lcm->origin) === "Panamá") selected @endif>Panamá</option>
            <option @if (old('origin', $lcm->origin) === "Papúa Nueva Guinea") selected @endif>Papúa Nueva Guinea</option>
            <option @if (old('origin', $lcm->origin) === "Paraguay") selected @endif>Paraguay</option>
            <option @if (old('origin', $lcm->origin) === "Perú") selected @endif>Perú</option>
            <option @if (old('origin', $lcm->origin) === "Polonia") selected @endif>Polonia</option>
            <option @if (old('origin', $lcm->origin) === "Portugal") selected @endif>Portugal</option>
            <option @if (old('origin', $lcm->origin) === "Reino Unido de Gran Bretaña e Irlanda del Norte") selected @endif>Reino Unido de Gran Bretaña e Irlanda del Norte</option>
            <option @if (old('origin', $lcm->origin) === "República Centroafricana") selected @endif>República Centroafricana</option>
            <option @if (old('origin', $lcm->origin) === "República Checa") selected @endif>República Checa</option>
            <option @if (old('origin', $lcm->origin) === "República del Congo") selected @endif>República del Congo</option>
            <option @if (old('origin', $lcm->origin) === "República Democrática del Congo") selected @endif>República Democrática del Congo</option>
            <option @if (old('origin', $lcm->origin) === "República Dominicana") selected @endif>República Dominicana</option>
            <option @if (old('origin', $lcm->origin) === "República Sudafricana") selected @endif>República Sudafricana</option>
            <option @if (old('origin', $lcm->origin) === "Ruanda") selected @endif>Ruanda</option>
            <option @if (old('origin', $lcm->origin) === "Rumanía") selected @endif>Rumanía</option>
            <option @if (old('origin', $lcm->origin) === "Rusia") selected @endif>Rusia</option>
            <option @if (old('origin', $lcm->origin) === "Samoa") selected @endif>Samoa</option>
            <option @if (old('origin', $lcm->origin) === "San Cristóbal y Nieves") selected @endif>San Cristóbal y Nieves</option>
            <option @if (old('origin', $lcm->origin) === "San Marino") selected @endif>San Marino</option>
            <option @if (old('origin', $lcm->origin) === "San Vicente y las Granadinas") selected @endif>San Vicente y las Granadinas</option>
            <option @if (old('origin', $lcm->origin) === "Santa Lucía") selected @endif>Santa Lucía</option>
            <option @if (old('origin', $lcm->origin) === "Santo Tomé y Príncipe") selected @endif>Santo Tomé y Príncipe</option>
            <option @if (old('origin', $lcm->origin) === "Senegal") selected @endif>Senegal</option>
            <option @if (old('origin', $lcm->origin) === "Serbia") selected @endif>Serbia</option>
            <option @if (old('origin', $lcm->origin) === "Seychelles") selected @endif>Seychelles</option>
            <option @if (old('origin', $lcm->origin) === "Sierra Leona") selected @endif>Sierra Leona</option>
            <option @if (old('origin', $lcm->origin) === "Singapur") selected @endif>Singapur</option>
            <option @if (old('origin', $lcm->origin) === "Siria") selected @endif>Siria</option>
            <option @if (old('origin', $lcm->origin) === "Somalia") selected @endif>Somalia</option>
            <option @if (old('origin', $lcm->origin) === "Sri Lanka") selected @endif>Sri Lanka</option>
            <option @if (old('origin', $lcm->origin) === "Suazilandia") selected @endif>Suazilandia</option>
            <option @if (old('origin', $lcm->origin) === "Sudán") selected @endif>Sudán</option>
            <option @if (old('origin', $lcm->origin) === "Sudán del Sur") selected @endif>Sudán del Sur</option>
            <option @if (old('origin', $lcm->origin) === "Suecia") selected @endif>Suecia</option>
            <option @if (old('origin', $lcm->origin) === "Suiza") selected @endif>Suiza</option>
            <option @if (old('origin', $lcm->origin) === "Surinam") selected @endif>Surinam</option>
            <option @if (old('origin', $lcm->origin) === "Tailandia") selected @endif>Tailandia</option>
            <option @if (old('origin', $lcm->origin) === "Tanzania") selected @endif>Tanzania</option>
            <option @if (old('origin', $lcm->origin) === "Tayikistán") selected @endif>Tayikistán</option>
            <option @if (old('origin', $lcm->origin) === "Timor Oriental") selected @endif>Timor Oriental</option>
            <option @if (old('origin', $lcm->origin) === "Togo") selected @endif>Togo</option>
            <option @if (old('origin', $lcm->origin) === "Tonga") selected @endif>Tonga</option>
            <option @if (old('origin', $lcm->origin) === "Trinidad y Tobago") selected @endif>Trinidad y Tobago</option>
            <option @if (old('origin', $lcm->origin) === "Túnez") selected @endif>Túnez</option>
            <option @if (old('origin', $lcm->origin) === "Turkmenistán") selected @endif>Turkmenistán</option>
            <option @if (old('origin', $lcm->origin) === "Turquía") selected @endif>Turquía</option>
            <option @if (old('origin', $lcm->origin) === "Tuvalu") selected @endif>Tuvalu</option>
            <option @if (old('origin', $lcm->origin) === "Ucrania") selected @endif>Ucrania</option>
            <option @if (old('origin', $lcm->origin) === "Uganda") selected @endif>Uganda</option>
            <option @if (old('origin', $lcm->origin) === "Uruguay") selected @endif>Uruguay</option>
            <option @if (old('origin', $lcm->origin) === "Uzbekistán") selected @endif>Uzbekistán</option>
            <option @if (old('origin', $lcm->origin) === "Vanuatu") selected @endif>Vanuatu</option>
            <option @if (old('origin', $lcm->origin) === "Venezuela") selected @endif>Venezuela</option>
            <option @if (old('origin', $lcm->origin) === "Vietnam") selected @endif>Vietnam</option>
            <option @if (old('origin', $lcm->origin) === "Yemen") selected @endif>Yemen</option>
            <option @if (old('origin', $lcm->origin) === "Yibuti") selected @endif>Yibuti</option>
            <option @if (old('origin', $lcm->origin) === "Zambia") selected @endif>Zambia</option>
            <option @if (old('origin', $lcm->origin) === "Zimbabue") selected @endif>Zimbabue</option>
          </select>
          @error('country')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('manufacturing_place') has-error @enderror">
          <label for="manufacturing_place" class="mb-4">Lugar de Fabricación <sup>*</sup></label>
          <input type="text" name="manufacturing_place" class="form-control" required aria-required value="{{ old('manufacturing_place', $lcm->manufacturing_place) }}">
          @error('manufacturing_place')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('commercial_name') has-error @enderror">
          <label for="commercial_name" class="mb-4">Denominación Comercial <sup>*</sup></label>
          <input type="text" name="commercial_name" class="form-control" required aria-required value="{{ old('commercial_name', $lcm->commercial_name) }}">
          @error('commercial_name')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('brand') has-error @enderror">
          <label for="brand" class="mb-4">Marca <sup>*</sup></label>
          <input type="text" name="brand" class="form-control" required aria-required value="{{ old('brand', $lcm->brand) }}">
          @error('brand')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('model') has-error @enderror">
          <label for="model" class="mb-4">Modelo <sup>*</sup></label>
          <input type="text" name="model" class="form-control" required aria-required value="{{ old('model', $lcm->model) }}">
          @error('model')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="w-1/2 form-group item-form px-4 @error('category') has-error @enderror">
          <label for="category" class="mb-4">Categoría <sup>*</sup></label>
          <input type="text" name="category" class="form-control" required aria-required value="{{ old('category', $lcm->category) }}">
          @error('category')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>


        <div class="w-1/2 form-group item-form px-4 @error('version') has-error @enderror">
          <label for="version" class="mb-4">Versión (Nro. VIN) <sup>*</sup></label>
          <input type="text" name="version" class="form-control" required aria-required value="{{ old('version', $lcm->version) }}">
          @error('version')
            <p class="help-block error">
              {{ $message }}
            </p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end">
        <a class="btn btn-success uppercase mr-4" href="{{ route('lcms.index') }}">
          Volver
        </a>

        <button class="btn btn-info uppercase" type="submit">
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
    select: '#select-origin',
    placeholder: 'Seleccione el origen',
    showSearch: false,
  })
</script>
@endpush
