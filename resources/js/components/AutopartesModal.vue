<template>
  <div class="modal fade" id="crear-autoparte" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form @submit.prevent="done">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 v-if="editing !== 0" class="modal-title">{{ editing === -1 ? 'Agregar' : 'Editar' }} autoparte</h4>
            <h4 v-else class="modal-title">Ver autoparte</h4>
          </div>
          <div class="modal-body pb-0">
            <div class="flex flex-wrap -mx-2">
              <div class="w-1/4 form-group item-form px-2 relative">
                <label class="mb-4">Producto <sup>*</sup></label>
                <select
                  v-if="editing !== 0"
                  required
                  aria-required
                  name="product"
                  class="form-control"
                  v-model="$attrs.value.product_id"
                  ref="selectProduct"
                >
                  <option data-placeholder="true"></option>
                  <option
                    v-for="product in products"
                    :key="`product-${product.id}`"
                    :value="product.id"
                  >
                    {{ `${product.category} ${product.name}` }}
                  </option>
                </select>
                <input
                  v-else
                  readonly
                  class="form-control"
                  :value="`${$attrs.value.product.category} ${$attrs.value.product.name}`"
                >
                <!-- <p class="help-block error hidden">Seleccione el producto</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2 relative">
                <label class="mb-4">Categoría NCM <sup>*</sup></label>
                <select
                  v-if="editing !== 0"
                  required
                  aria-required
                  name="ncm"
                  class="form-control"
                  v-model="$attrs.value.ncm_id"
                  ref="selectNcm"
                >
                  <option data-placeholder="true"></option>
                  <option
                    v-for="row in ncm"
                    :key="`ncm-${row.id}`"
                    :value="row.id"
                  >
                    {{ `${row.category} ${row.description}` }}
                  </option>
                  <!-- <option
                    v-for="category in ncm"
                    :key="`ncm-${category.category}`"
                    :value="ncm.id"
                  >
                    {{ `${category.category}` }}
                  </option> -->
                </select>
                <input
                  v-else
                  readonly
                  class="form-control"
                  :value="`${$attrs.value.ncm.category} ${$attrs.value.ncm.description}`"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Fabricante <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="manufacturer"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.manufacturer"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Importador <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="importer"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.importer"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Razón Social <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="business_name"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.business_name"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Part Number <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="part_number"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.part_number"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Descripción <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="description"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.description"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Marca <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="brand"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.brand"
                >
                <!-- <p class="help-block error hidden">Ingrese la marca</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Modelo <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="model"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.model"
                >
                <!-- <p class="help-block error hidden">Ingrese el modelo</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2 relative">
                <label class="mb-4">Origen <sup>*</sup></label>
                <select
                  v-if="editing !== 0"
                  v-model="$attrs.value.origin"
                  name="origin"
                  class="form-control"
                  required
                  aria-required
                  ref="selectOrigin"
                >
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
                <input
                  v-else
                  class="form-control"
                  readonly
                  :value="$attrs.value.origin"
                >
                <!-- <p class="help-block error hidden">Ingrese el origen</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Tamaño/Talle <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="size"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.size"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Formulación <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="formulation"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.formulation"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Aplicación <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="application"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.application"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Fecha de certificación <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="certified_at"
                  type="date"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.certified_at"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Licencia de certificación <sup>*</sup></label>
                <input
                  :readonly="editing === 0"
                  name="license"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.license"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <!-- <div class="w-full item-form px-2">
                <label class="mb-4">Fotos <sup>*</sup></label>
                <div class="swiper-container mb-4" ref="swiper" v-show="editing !== -1">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="picture in $attrs.value.pictures">
                      <img class="w-64" :src="picture">
                      <button
                        type="button"
                        @click="removePicture(picture)"
                        class="absolute top-0 right-0 z-10 w-6 h-6 rounded-full p-0 mt-1 mr-1 shadow bg-rojo text-white"
                      >
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
                <file-pond
                  allow-multiple
                  name="picture"
                  ref="pond"
                  :accepted-file-types="['image/*']"
                  label-file-type-not-allowed="Debe elegir una imagen"
                  file-validate-type-label-expected-types="Archivos JPG, PNG"
                  :label-idle="'Arrastre los archivos aquí o <span class=\'filepond--label-action\'>búsquelos</span>'"
                  label-file-processing="Subiendo"
                  label-tap-to-cancel="toque para cancelar"
                  label-tap-to-undo="toque para deshacer"
                  label-file-processing-complete="Subida completa"
                  :server="{
                    process: {
                      url: '/subir/imagenes',
                      method: 'post',
                      onload: response => $attrs.value.pictures = [...($attrs.value.pictures || []), response],
                    },
                    revert: (uniqueFileId, load) => ($delete($attrs.value.pictures, $attrs.value.pictures.indexOf(uniqueFileId[0])), load())
                  }"
                  @addfile="() => uploading = true"
                  @processfiles="() => uploading = false"
                >
                </file-pond>
                <p class="help-block error hidden">Agregue una foto</p>
              </div> -->
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Volver
            </button>
            <button
              v-if="editing !== 0"
              type="submit"
              class="btn btn-primary"
              :disabled="uploading"
            >
              {{ editing === -1 ? 'Agregar' : 'Editar' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { cloneDeep, tap, set } from 'lodash'
// import vueFilePond from 'vue-filepond'
// import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js'
// import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js'
// import 'filepond/dist/filepond.min.css'
// import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'

// const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview)

export default {
  name: 'AutopartesModal',

  // components: {
  //   FilePond
  // },

  props: ['products', 'editing', 'ncm'],

  data () {
    return {
      uploading: false
    }
  },

  methods: {
    // initSwiper () {
    //   new Swiper.default(this.$refs.swiper, {
    //     navigation: {
    //       nextEl: '.swiper-button-next',
    //       prevEl: '.swiper-button-prev',
    //     },
    //   })
    // },

    // removePicture (picture) {
    //   this.$delete(this.$attrs.value.pictures, this.$attrs.value.pictures.indexOf(picture))
    //   this.$nextTick(() => {
    //     this.initSwiper()
    //   })
    // },

    done () {
      this.$emit('done')
    },
  },

  mounted () {
    if (this.editing !== 0) {
      new SlimSelect({
        select: this.$refs.selectProduct,
        placeholder: 'Seleccione el producto',
        searchPlaceholder: 'Buscar',
      })

      new SlimSelect({
        select: this.$refs.selectNcm,
        placeholder: 'Seleccione la categoría NCM',
        searchPlaceholder: 'Buscar',
      })

      new SlimSelect({
        select: this.$refs.selectOrigin,
        placeholder: 'Seleccione el origen',
        searchPlaceholder: 'Buscar',
      })
    }

    // $('#crear-autoparte').on('shown.bs.modal', e => {
    //   this.initSwiper()
    // })
  }
}
</script>
