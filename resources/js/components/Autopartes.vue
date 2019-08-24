<script>
export default {
  name: 'Autopartes',

  props: ['oldAutopartes', 'certificate'],

  data () {
    return {
      autopartes: [],
      autoparte: {},
      showModal: false,
      editing: null
    }
  },

  computed: {
    autopartesJSON () {
      return this.autopartes.map(autoparte => JSON.stringify(autoparte))
    },

    computedAutoparte () {
      return {
        ...this.autoparte,
        product_id: this.autoparte.product.id
      }
    }
  },

  methods: {
    add () {
      this.editing = -1
      this.autoparte = {}
      this.openModal()
    },

    edit (autoparte, index) {
      this.editing = index
      this.autoparte = { ...autoparte }
      this.openModal()
    },

    addToIndex () {
      this.destroyTable()
      if (this.editing === -1) {
        this.autopartes.push({ ...this.computedAutoparte })
      } else {
        this.autopartes.splice(this.editing, 1, { ...this.computedAutoparte })
      }
      this.$nextTick(() => {
        this.initTable()
        this.closeModal()
        this.clear()
      })
    },

    removeFromIndex (index) {
      this.destroyTable()
      this.autopartes.splice(index, 1)
      this.$nextTick(() => {
        this.initTable()
      })
    },

    clear () {
      this.autoparte = {}
    },

    clearIndex () {
      this.destroyTable()
      this.autopartes = []
      this.$nextTick(() => {
        this.initTable()
      })
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
    },

    openModal () {
      this.showModal = true
      this.$nextTick(() => {
        $('#crear-autoparte').modal('show')
        $('#crear-autoparte').on('hidden.bs.modal', e => {
          this.showModal = false
          this.clear()
        })
      })
    },

    closeModal () {
      $('#crear-autoparte').modal('hide')
    }
  },

  created () {
    if (this.oldAutopartes.length > 0) {
      this.autopartes = this.oldAutopartes.map(a => JSON.parse(a))
    } else if (this.certificate) {
      this.autopartes = this.certificate.autoparts
    }
  },

  mounted () {
    this.initTable()
  }
}
</script>
