<template>
  <!-- <div> -->
    <input
      type="file"
      class="form-control"
      @input="validateImport"
    >
    <!-- posible feature -->
    <!-- <template v-for="(autopart, index) in valid">
      <input
        v-for="(value, key) in autopart"
        :name="`nombre[${index}][${key}]`"
        type="hidden"
        :value="value"
      >
    </template> -->
  <!-- </div> -->
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
          text: Object.values(error.response.data.errors).flat().join(', ')
        })
      })
    }
  }
}
</script>
