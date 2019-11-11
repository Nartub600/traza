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
        this.$emit('valid', response.data)
      }).catch(error => {
        e.target.value = null
        Swal.fire({
          type: 'warning',
          title: 'Hubo errores',
          html: error.response.data.errors ? Object.values(error.response.data.errors).flat().join('<br>') : 'Falla general'
        })
      })
    }
  }
}
</script>
