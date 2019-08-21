window.Vue = require('vue')
window.$ = require('jquery')
window.jQuery = window.$
require('bootstrap/dist/js/bootstrap.min.js')
require('datatables.net-dt')

Vue.component('autopartes', require('./components/Autopartes.vue').default);

const app = new Vue({
  name: 'App',
  el: '#traza',
})
