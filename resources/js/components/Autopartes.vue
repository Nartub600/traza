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
        ...(this.autoparte.product_id && { product_name: this.products.find(p => p.id === this.autoparte.product_id).name })
      }
    }
  },

  methods: {
    beginCertificatesImport () {
      Swal.fire({
        type: 'info',
        title: 'Importación masiva de certificados',
        confirmButtonText: 'Seleccionar archivo',
        html: `
          <p>Se debe seleccionar un archivo Excel con un máximo de 100 autopartes y el siguiente formato:</p>
          <table class="table table-bordered">
            <tr class="text-xs">
              <td>Número</td>
              <td>CUIT</td>
              <td>Producto</td>
              <td>Autoparte</td>
              <td>Descripción</td>
              <td>Marca</td>
              <td>Modelo</td>
              <td>Origen</td>
            </tr>
          </table>
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
        confirmButtonText: 'Seleccionar archivo',
        html: `
          <p>Se debe seleccionar un archivo Excel con un máximo de 100 autopartes y el siguiente formato:</p>
          <table class="table table-bordered">
            <tr class="text-xs">
              <td>Producto</td>
              <td>Autoparte</td>
              <td>Descripción</td>
              <td>Marca</td>
              <td>Modelo</td>
              <td>Origen</td>
            </tr>
          </table>
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
      this.autopartes.forEach((a, i) => {
        new Swiper.default(this.$refs[`swiper${i}`], {
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        })
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
    },

    parseCertificatesFeedback (response) {
      const certificatesMessage = response.certificates.length
      ? `${response.certificates.length} ${response.certificates.length > 1 ? 'certificados válidos' : 'certificado válido'}`
      : 'No se detectaron certificados para importar'

      const invalidRowsMessage = response.invalid.rows.length
      ? `${response.invalid.rows.length} ${response.invalid.rows.length > 1 ? 'filas inválidas' : 'fila inválida'}`
      : ''

      const invalidCertificatesMessage = response.invalid.rows.length
      ? `${response.invalid.certificates.length} ${response.invalid.certificates.length > 1 ? 'certificados inválidos' : 'certificado inválido'}`
      : ''

      const invalidRowsDetail = response.invalid.rows.length
      ? '<div class="text-left"><h3 class="text-sm">Filas con errores</h3>' + response.invalid.rows.map(r => {
        return `<p class="text-xs my-0">Fila ${r.index}: ${Object.values(r.errors).join(' ')}</p>`
      }).join('') + '</div>'
      : ''

      const invalidCertificatesDetail = response.invalid.certificates.length
      ? '<div class="text-left"><h3 class="text-sm">Certificados con errores</h3>' + response.invalid.certificates.map(c => {
        return `<p class="text-xs my-0">Certificado ${c[0].number}: no coinciden los CUIT</p>`
      }).join('') + '</div>'
      : ''

      const certificatesDetail = response.certificates.length
      ? '<div class="text-left"><h3 class="text-sm">Certificados a Importar</h3>' + response.certificates.map(c => {
        return `<p class="text-xs my-0">
          Número: ${c.number}<br>
          CUIT: ${c.cuit}<br>
          Autopartes:
          <ul class="text-xs">
            ${c.autoparts.map(a => {
              return `<li>
                Producto: ${a.product.name}<br>
                Autoparte: ${a.name}<br>
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

      const invalidRowsMessage = response.invalid.length
      ? `${response.invalid.length} ${response.invalid.length > 1 ? 'filas inválidas' : 'fila inválida'}`
      : ''

      const invalidRowsDetail = response.invalid.length
      ? '<div class="text-left"><h3 class="text-sm">Filas con errores</h3>' + response.invalid.map(r => {
        return `<p class="text-xs my-0">Fila ${r.index}: ${Object.values(r.errors).join(', ')}</p>`
      }).join('') + '</div>'
      : ''

      return `<p>${[autopartsMessage, invalidRowsMessage].filter(Boolean).join(', ')}</p>` + invalidRowsDetail
    },

    handleCertificatesExcel () {
      const importData = new FormData()
      importData.append('excel', this.$refs.excel.files[0]);
      fetch('/importar/certificados', {
        method: 'post',
        body: importData
      })
      .then(response => {
        if (!response.ok) {
          throw response
        }
        return response.json()
      })
      .then(data => {
        Swal.fire({
          title: 'Confirmar importación',
          html: this.parseCertificatesFeedback(data),
          type: 'question',
          showConfirmButton: data.certificates.length > 0,
          showCancelButton: true,
          confirmButtonText: 'Importar',
          cancelButtonText: 'Volver',
          reverseButtons: true,
          confirmButtonColor: '#0072BB',
          showLoaderOnConfirm: true,
          preConfirm: () => fetch('/certificados', {
            method: 'post',
            body: JSON.stringify({
              'certificates': data.certificates
            }),
            headers: {
              'X-CSRF-TOKEN': Laravel.csrfToken,
              'Content-Type': 'application/json',
              'Accept': 'application/json',
            }
          })
        }).then(result => {
          if (result.value) {
            location.reload()
          }
        })
      })
      .catch(error => {
        error.json().then(data => {
          Swal.fire({
            type: 'warning',
            text: data.rows
          })
        })
      })
    },

    handleAutopartsExcel () {
      const formData = new FormData()
      formData.append('excel', this.$refs.excel.files[0]);
      fetch('/importar/autopartes', {
        method: 'post',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw response
        }
        return response.json()
      })
      .then(data => {
        this.destroyTable()
        this.autopartes = data.autoparts
        this.$nextTick(() => {
          this.initTable()
        })

        Swal.fire({
          type: data.autoparts.length && !data.invalid.length ? 'success' : (data.autoparts.length && data.invalid.length ? 'warning' : 'error'),
          title: 'Operación finalizada',
          html: this.parseAutopartsFeedback(data)
        })
      })
      .catch(error => {
        error.json().then(data => {
          Swal.fire({
            type: 'warning',
            text: data.rows
          })
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
