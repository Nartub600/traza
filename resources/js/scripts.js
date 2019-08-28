window.Vue = require('vue')
window.$ = require('jquery')
window.Swal = require('sweetalert2')
window.jQuery = window.$
require('bootstrap/dist/js/bootstrap.min.js')
require('datatables.net-dt')

Vue.component('autopartes', require('./components/Autopartes.vue').default);
Vue.component('autopartes-modal', require('./components/AutopartesModal.vue').default);
Vue.component('permisos', require('./components/Permisos.vue').default);

const app = new Vue({
  name: 'App',

  el: '#traza',

  data () {
    return {
      uploading: false
    }
  }
})
