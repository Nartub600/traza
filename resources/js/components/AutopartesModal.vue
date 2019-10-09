<template>
  <div class="modal fade" id="crear-autoparte" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form @submit.prevent="done">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ editing === -1 ? 'Agregar' : 'Editar' }} producto</h4>
          </div>
          <div class="modal-body pb-0">
            <div class="flex flex-wrap -mx-2">
              <div class="w-1/4 form-group item-form px-2 relative">
                <label class="mb-4">Producto <sup>*</sup></label>
                <select
                  required
                  aria-required
                  name="product"
                  class="form-control"
                  v-model="$attrs.value.product_id"
                  ref="selectProduct"
                >
                  <option data-placeholder="true"></option>
                  <option
                    v-for="product in flatProducts"
                    :key="`product-${product.id}`"
                    :value="product.id"
                  >
                    {{ `${product.category} ${product.name}` }}
                  </option>
                </select>
                <!-- <p class="help-block error hidden">Seleccione el producto</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2 relative">
                <label class="mb-4">Familia <sup>*</sup></label>
                <select
                  required
                  aria-required
                  name="family"
                  class="form-control"
                  v-model="$attrs.value.family_id"
                  ref="selectFamily"
                >
                  <option data-placeholder="true"></option>
                  <option
                    v-for="product in products"
                    :key="`family-${product.id}`"
                    :value="product.id"
                  >
                    {{ product.name }}
                  </option>
                </select>
                <!-- <p class="help-block error hidden">Ingrese la autoparte</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Categoría NCM <sup>*</sup></label>
                <input
                  name="ncm_category"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.ncm_category"
                >
                <!-- <p class="help-block error hidden">Ingrese la descripción</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Fabricante <sup>*</sup></label>
                <input
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
                  name="model"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.model"
                >
                <!-- <p class="help-block error hidden">Ingrese el modelo</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Origen <sup>*</sup></label>
                <input
                  name="origin"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="$attrs.value.origin"
                >
                <!-- <p class="help-block error hidden">Ingrese el origen</p> -->
              </div>

              <div class="w-1/4 form-group item-form px-2">
                <label class="mb-4">Tamaño/Talle <sup>*</sup></label>
                <input
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

  props: ['products', 'editing'],

  data () {
    return {
      uploading: false
    }
  },

  computed: {
    flatProducts () {
      return this.flat(this.products)
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

    flat (products) {
      const flat = []

      products.forEach(p => {
        flat.push(p)
        if (p.children.length > 0) {
          flat.push(...this.flat(p.children))
        }
      })

      return flat
    },

    done () {
      this.$emit('done')
    },
  },

  mounted () {
    new SlimSelect({
      select: this.$refs.selectProduct,
      placeholder: 'Seleccione el producto',
      searchPlaceholder: 'Buscar',
    })

    new SlimSelect({
      select: this.$refs.selectFamily,
      placeholder: 'Seleccione la familia',
      searchPlaceholder: 'Buscar',
    })

    // $('#crear-autoparte').on('shown.bs.modal', e => {
    //   this.initSwiper()
    // })
  }
}
</script>
