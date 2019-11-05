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
      // uploading: false
      excel: false,
      wp29: false,
      lcms: [],
      nacional: [],
      extranjera: [],
      excepcion: []
    }
  },

  computed: {
    trazaIsValid () {
      return this.excel && (this.extranjera.length > 0 ? this.wp29 : true)
    }
  }
})
