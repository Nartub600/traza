<script>
export default {
  name: 'Autopartes',

  props: {
    products: {
      type: Array,
      default: () => []
    },

    oldAutopartes: {
      type: Array,
      default: () => []
    },

    certificate: {
      type: Object,
      default: () => null
    },

    certificatesTemplate: {
      type: String
    },

    autopartsTemplate: {
      type: String
    },

    ncm: {
      type: Array,
      default: () => []
    }
  },

  data () {
    return {
      autopartes: [],
      autoparte: {},
      showModal: false,
      editing: null
    }
  },

  computed: {
    computedAutoparte () {
      return {
        ...this.autoparte,
        ...(this.autoparte.product_id && { product_string: `${this.flatProducts.find(p => p.id === this.autoparte.product_id).category} ${this.flatProducts.find(p => p.id === this.autoparte.product_id).name}` }),
        ...(this.autoparte.ncm_id && { ncm_string: `${this.ncm.find(p => p.id === this.autoparte.ncm_id).category} ${this.ncm.find(p => p.id === this.autoparte.ncm_id).description}` })
      }
    },

    flatProducts () {
      return this.flat(this.products)
    }
  },

  methods: {
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

    beginCertificatesImport () {
      Swal.fire({
        type: 'info',
        title: 'Importación masiva de licencias',
        confirmButtonText: '<span class="uppercase">Seleccionar archivo</span>',
        html: `
          <p>Se debe seleccionar un archivo Excel con un máximo de 100 autopartes y el formato de la siguiente plantilla:</p>
          <a class="btn btn-success" href="${this.certificatesTemplate}" download>
            Descargar plantilla
          </a>
          <p>Se ignorará la primera fila</p>
        `
      }).then(result => {
        if (result.value) {
          this.$refs.excel.value = null
          this.$refs.excel.click()
        }
      })
    },

    beginAutopartsImport () {
      Swal.fire({
        type: 'info',
        title: 'Importación masiva de autopartes',
        confirmButtonText: '<span class="uppercase">Seleccionar archivo</span>',
        html: `
          <p>Se debe seleccionar un archivo Excel con un máximo de 100 autopartes y el formato de la siguiente plantilla:</p>
          <a class="btn btn-success" href="${this.autopartsTemplate}" download>
            Descargar plantilla
          </a>
          <p>Se ignorará la primera fila</p>
        `
      }).then(result => {
        if (result.value) {
          this.$refs.excel.value = null
          this.$refs.excel.click()
        }
      })
    },

    add () {
      this.editing = -1
      this.autoparte = {}
      this.openModal()
    },

    view (autoparte) {
      this.autoparte = { ...autoparte }
      this.editing = 0
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
      // this.autopartes.forEach((a, i) => {
      //   new Swiper.default(this.$refs[`swiper${i}`], {
      //     navigation: {
      //       nextEl: '.swiper-button-next',
      //       prevEl: '.swiper-button-prev',
      //     },
      //   })
      // })
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
    },

    parseCertificatesFeedback (response) {
      const certificatesMessage = response.certificates.valid.length
      ? `${response.certificates.valid.length} ${response.certificates.valid.length > 1 ? 'licencias válidas' : 'licencia válida'}`
      : 'No se detectaron licencias para importar'

      const duplicatedRowsMessage = response.rows.valid.length - response.rows.unique.length > 0
      ? `${response.rows.valid.length - response.rows.unique.length} ${response.rows.valid.length - response.rows.unique.length > 1 ? 'filas se ignoraron' : 'fila se ignoró'} por tener información duplicada`
      : ''

      const invalidRowsMessage = response.rows.invalid.length
      ? `${response.rows.invalid.length} ${response.rows.invalid.length > 1 ? 'filas inválidas' : 'fila inválida'}`
      : ''

      const invalidCertificatesMessage = response.certificates.invalid.length
      ? `${response.certificates.invalid.length} ${response.certificates.invalid.length > 1 ? 'licencias inválidas' : 'licencia inválida'}`
      : ''

      const invalidRowsDetail = response.rows.invalid.length
      ? '<div class="text-left"><h3 class="text-sm">Filas con errores</h3>' + response.rows.invalid.map(r => {
        return `<p class="text-xs my-0">Fila ${r.index}: ${Object.values(r.errors).join(', ')}</p>`
      }).join('') + '</div>'
      : ''

      const invalidCertificatesDetail = response.certificates.invalid.length
      ? '<div class="text-left"><h3 class="text-sm">Licencias con errores</h3>' + response.certificates.invalid.map(c => {
        return `<p class="text-xs my-0">Certificado ${c[0].number}: no coinciden los CUIT</p>`
      }).join('') + '</div>'
      : ''

      const certificatesDetail = response.certificates.valid.length
      ? '<div class="text-left"><h3 class="text-sm">Licencias a Importar</h3>' + response.certificates.valid.map(c => {
        return `<p class="text-xs my-0">
          Número: ${c.number}<br>
          CUIT: ${c.cuit}<br>
          Autopartes:
          <ul class="text-xs flex flex-wrap">
            ${c.autoparts.map(a => {
              return `<li class="w-1/2 p-1">
                Producto: ${a.product_string}<br>
                Descripción: ${a.description}<br>
                Marca: ${a.brand}<br>
                Modelo: ${a.model}<br>
                Origen: ${a.origin}<br>
              </li>`
            }).join('')}
          </ul>
        </p>`
      }).join('') + '</div>'
      : ''

      return `<p>${[certificatesMessage, invalidRowsMessage, invalidCertificatesMessage].filter(Boolean).join(', ')}</p>` + invalidRowsDetail + invalidCertificatesDetail + certificatesDetail
    },

    parseAutopartsFeedback (response) {
      const autopartsMessage = response.autoparts.length
      ? `${response.autoparts.length} ${response.autoparts.length > 1 ? 'autopartes fueron agregadas' : 'autoparte fue agregada'} al listado`
      : 'No se importaron autopartes'

      const duplicatedRowsMessage = response.valid.length - response.autoparts.length > 0
      ? `${response.valid.length - response.autoparts.length} ${response.valid.length - response.autoparts.length > 1 ? 'filas se ignoraron' : 'fila se ignoró'} por tener información duplicada`
      : ''

      const invalidRowsMessage = response.invalid.length
      ? `${response.invalid.length} ${response.invalid.length > 1 ? 'filas inválidas' : 'fila inválida'}`
      : ''

      const invalidRowsDetail = response.invalid.length
      ? '<div class="text-left"><h3 class="text-sm">Filas con errores</h3>' + response.invalid.map(r => {
        return `<p class="text-xs my-0">Fila ${r.index}: ${Object.values(r.errors).join(', ')}</p>`
      }).join('') + '</div>'
      : ''

      return `<p>${[duplicatedRowsMessage, autopartsMessage, invalidRowsMessage].filter(Boolean).join(', ')}</p>` + invalidRowsDetail
    },

    handleCertificatesExcel () {
      const importData = new FormData()
      importData.append('excel', this.$refs.excel.files[0]);
      axios.post('/importar/licencias', importData)
      .then(response => {
        Swal.fire({
          width: '64rem',
          title: 'Confirmar importación',
          html: this.parseCertificatesFeedback(response.data),
          type: 'question',
          showConfirmButton: response.data.certificates.valid.length > 0,
          showCancelButton: true,
          confirmButtonText: 'Importar',
          cancelButtonText: 'Volver',
          reverseButtons: true,
          confirmButtonColor: '#0072BB',
          showLoaderOnConfirm: true,
          preConfirm: () => axios.post('/licencias', {
            'certificates': response.data.certificates.valid
          }, {
            headers: {
              'X-CSRF-TOKEN': Laravel.csrfToken,
              'Accept': 'application/json',
            }
          })
        }).then(result => {
          if (result.value) {
            location.reload()
          }
        }).catch(error => {
          console.log(error)
          return false
        })
      })
      .catch(error => {
        Swal.fire({
          type: 'warning',
          text: error.response.data.rows || 'Error inesperado'
        })
      })
    },

    handleAutopartsExcel () {
      const formData = new FormData()
      formData.append('excel', this.$refs.excel.files[0]);
      axios.post('/importar/autopartes', formData)
      .then(response => {
        this.destroyTable()
        this.autopartes = response.data.autoparts
        this.$nextTick(() => {
          this.initTable()
        })

        Swal.fire({
          type: response.data.autoparts.length && !response.data.invalid.length ? 'success' : (response.data.autoparts.length && response.data.invalid.length ? 'warning' : 'error'),
          title: 'Operación finalizada',
          html: this.parseAutopartsFeedback(response.data)
        })
      })
      .catch(error => {
        Swal.fire({
          type: 'warning',
          text: error.response.data.rows || 'Error inesperado'
        })
      })
    }
  },

  created () {
    if (this.oldAutopartes.length) {
      this.autopartes = this.oldAutopartes
    } else if (this.certificate) {
      this.autopartes = this.certificate.autoparts
    }
  },

  mounted () {
    this.initTable()
  }
}
</script>
