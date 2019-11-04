<template>
  <input
    type="file"
    class="form-control"
    @input="validateImport"
  >
</template>

<script>
export default {
  name: 'Importer',

  props: {
    endpoint: {
      required: true,
      type: String
    }
  },

  data () {
    return {
      valid: []
    }
  },

  methods: {
    validateImport (e) {
      const data = new FormData;
      data.append('excel', e.target.files[0])

      axios.post(this.endpoint, data).then(response => {
        Swal.fire({
          type: 'success',
          title: 'El archivo es válido'
        })

        this.$emit('valid', response.data)
      }).catch(error => {
        e.target.value = null
        Swal.fire({
          type: 'warning',
          title: 'Hubo errores',
          text: error.response.data.errors ? Object.values(error.response.data.errors).flat().join(', ') : 'Falla general'
        })
      })
    }
  }
}
</script>
