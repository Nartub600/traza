<script>
export default {
  name: 'TrazaForm',

  props: ['traza'],

  data () {
    return {
      excel: false,
      certificado: false,
      wp29: false,
      lcms: [],
      nacional: [],
      extranjera: [],
      excepcion: [],
      aprobar: [],
      loadedFiles: []
    }
  },

  computed: {
    trazaIsValid () {
      return this.excel &&
        (this.nacional.length > 0 ? this.certificado : true) &&
        (this.extranjera.length > 0 ? this.wp29 : true) &&
        this.filesAreComplete

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

      return null
    },

    expectedFiles () {
      return this.autopartes.flatMap(a => a.pictures.split(','))
    },

    filesAreComplete () {
      return this.loadedFiles.length > 0 && this.expectedFiles.every(f => this.loadedFiles.includes(f))
    }
  },

  methods: {
    parseLoadedFiles () {
      this.loadedFiles = this.currentRef ? [...this.currentRef.files].map(f => f.name) : []
    },

    showFileIsValid () {
      Swal.fire({
        type: 'success',
        title: 'El archivo es válido'
      })
    },

    showApprovalConfirmation () {
      Swal.fire({
        type: 'question',
        text: `Confirme la aprobación de ${this.aprobar.length} autopartes`,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#0072BB',
        confirmButtonText: '<span class="uppercase">Aprobar</span>',
        cancelButtonText: '<span class="uppercase">Volver</span>',
        reverseButtons: true,
        preConfirm: () => axios.patch(`/trazas/${this.traza.id}/aprobar`, {
          'autoparts': this.aprobar
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
    }
  },

  mounted () {
    this.$refs.selectSignature && new SlimSelect({
      select: this.$refs.selectSignature,
      placeholder: ' ',
      showSearch: false,
    })
  }
}
</script>
