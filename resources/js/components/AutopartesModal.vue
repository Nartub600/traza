<template>
  <div class="modal fade" id="crear-autoparte" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form @submit.prevent="done">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ editing === -1 ? 'Agregar' : 'Editar' }} producto</h4>
          </div>
          <div class="modal-body">
            <div class="flex flex-wrap -mx-4">
              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Producto <sup>*</sup></label>
                <select
                  name="product"
                  class="form-control"
                  v-model="value.product"
                >
                  <option disabled value="">---</option>
                  <option
                    v-for="product in products"
                    :key="`product-${product.id}`"
                    :value="product"
                  >
                    {{ product.name }}
                  </option>
                </select>
                <p class="help-block error hidden">Seleccione el producto</p>
              </div>

              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Autoparte <sup>*</sup></label>
                <input
                  name="name"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="value.name"
                >
                <p class="help-block error hidden">Ingrese la autoparte</p>
              </div>

              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Descripción <sup>*</sup></label>
                <input
                  name="description"
                  type="text"
                  class="form-control"
                  required
                  aria-required
                  v-model="value.description"
                >
                <p class="help-block error hidden">Ingrese la descripción</p>
              </div>

              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Marca <sup>*</sup></label>
                <input name="brand" type="text" class="form-control" required aria-required v-model="value.brand">
                <p class="help-block error hidden">Ingrese la marca</p>
              </div>

              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Modelo <sup>*</sup></label>
                <input name="model" type="text" class="form-control" required aria-required v-model="value.model">
                <p class="help-block error hidden">Ingrese el modelo</p>
              </div>

              <div class="w-1/2 form-group item-form px-4">
                <label class="mb-4">Origen <sup>*</sup></label>
                <input name="origin" type="text" class="form-control" required aria-required v-model="value.origin">
                <p class="help-block error hidden">Ingrese el origen</p>
              </div>

              <div class="w-full form-group item-form px-4">
                <label class="mb-4">Foto <sup>*</sup></label>
                <file-pond
                  name="picture"
                  ref="pond"
                  :accepted-file-types="['image/*']"
                  label-file-type-not-allowed="Debe elegir una imagen"
                  file-validate-type-label-expected-types="Archivos JPG, PNG"
                  :label-idle="'Arrastre un archivo aquí o <span class=\'filepond--label-action\'>elija uno</span>'"
                  label-file-processing="Subiendo"
                  label-tap-to-cancel="click para cancelar"
                  label-tap-to-undo="click para deshacer"
                  label-file-processing-complete="Subida completa"
                  :server="{
                    process: {
                      url: '/uploads',
                      method: 'post',
                      onload: response => value.picture = response,
                    }
                  }"
                  @addfile="() => uploading = true"
                  @processfile="() => uploading = false"
                >
                </file-pond>
                <p class="help-block error hidden">Agregue una foto</p>
              </div>
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
import vueFilePond from 'vue-filepond'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview)

export default {
  name: 'AutopartesModal',

  components: {
    FilePond
  },

  props: ['value', 'products', 'editing'],

  data () {
    return {
      uploading: false
    }
  },

  methods: {
    update (key, value) {
      this.$emit('input', tap(cloneDeep(this.value), v => set(v, key, value)))
    },

    done () {
      this.$emit('done')
    },
  }
}
</script>
