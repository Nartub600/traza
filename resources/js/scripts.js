window.Vue = require('vue')
window.$ = require('jquery')
window.jQuery = window.$
window.Swal = require('sweetalert2')
window.SlimSelect = require('slim-select')
window.Swiper = require('swiper')
window.axios = require('axios')
window.IMask = require('imask').default
require('bootstrap/dist/js/bootstrap.min.js')
require('datatables.net-dt')

Vue.component('autopartes', require('./components/Autopartes.vue').default)
Vue.component('autopartes-modal', require('./components/AutopartesModal.vue').default)
Vue.component('permisos', require('./components/Permisos.vue').default)
Vue.component('importer', require('./components/Importer.vue').default)
Vue.component('selector', require('./components/Selector.vue').default)
Vue.component('formalizer', require('./components/Formalizer.vue').default)

const app = new Vue({
  name: 'App',

  el: '#traza',

  data () {
    return {
      excel: false,
      wp29: false,
      lcms: [],
      nacional: [],
      extranjera: [],
      excepcion: [],
      loadedFiles: []
    }
  },

  computed: {
    trazaIsValid () {
      return this.excel && (this.extranjera.length > 0 ? this.wp29 : true) && this.filesAreComplete
    },

    autopartes () {
      if (this.nacional.length > 0) return this.nacional
      if (this.extranjera.length > 0) return this.extranjera
      if (this.lcms.length > 0) return this.lcms
      if (this.excepcion.length > 0) return this.excepcion

      return []
    },

    currentRef () {
      if (this.nacional.length > 0 || this.extranjera.length > 0)  return this.$refs.fotosCHAS
      if (this.lcms.length > 0) return this.$refs.fotosCAPE
      if (this.excepcion.length > 0) return this.$refs.fotosEX
    },

    expectedFiles () {
      return this.autopartes.flatMap(a => a.pictures.split(','))
    },

    filesAreComplete () {
      return this.loadedFiles.length > 0 && this.loadedFiles.every(f => this.expectedFiles.includes(f))
    }
  },

  methods: {
    parseLoadedFiles () {
      this.loadedFiles = [...this.currentRef.files].map(f => f.name)
    }
  }
})
