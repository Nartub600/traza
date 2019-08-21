<script>
export default {
  name: 'Autopartes',

  props: ['oldAutopartes'],

  data () {
    return {
      autopartes: [],
      autoparte: {}
    }
  },

  computed: {
    computedAutoparte () {
      return {
        ...this.autoparte,
        product_id: this.autoparte.product.id
      }
    },

    autopartesJSON () {
      return this.autopartes.map(autoparte => JSON.stringify(autoparte))
    }
  },

  methods: {
    add () {
      this.destroyTable()
      this.autopartes.push({...this.computedAutoparte})
      this.$nextTick(() => {
        this.initTable()
        $('#crear-autoparte').modal('hide')
        this.autoparte = {}
      })
    },

    remove () {

    },

    destroyTable () {
      $('#tabla').DataTable().destroy()
    },

    initTable () {
      $('#tabla').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
      })
    }
  },

  created () {
    if (this.oldAutopartes.length > 0) {
      this.autopartes = this.oldAutopartes.map(autoparte => JSON.parse(autoparte))
    }
  },

  mounted () {
    this.initTable()
  }
}
</script>
