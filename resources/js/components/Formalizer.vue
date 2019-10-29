<template>
  <div>
    <template v-for="(item, index) in data">
      <input
        v-for="(value, key) in item"
        type="hidden"
        :name="`${name}[${index}][${key}]`"
        :value="value"
      >
    </template>
  </div>
</template>

<script>
export default {
  name: 'Formalizer',

  props: {
    data: {
      type: Array,
      default: () => []
    },

    name: {
      type: String,
      required: true
    }
  }
}
</script>
