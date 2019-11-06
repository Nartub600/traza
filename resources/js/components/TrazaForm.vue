<script>
export default {
  name: 'TrazaForm',

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
      return this.excel && (this.extranjera.length > 0 ? this.wp29 : true) && (this.excepcion.length > 0 ? true : this.filesAreComplete)
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
    }
  },

  mounted () {
    new SlimSelect({
      select: this.$refs.selectSignature,
      placeholder: ' ',
      showSearch: false,
    })
  }
}
</script>
