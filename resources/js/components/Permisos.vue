<script>
import { groupBy, filter, xor, camelCase } from 'lodash'

export default {
  name: 'Permisos',

  props: ['permissions', 'old-permissions', 'role'],

  data () {
    return {
      selectedPermissions: [],
      collapse: {}
    }
  },

  methods: {
    groupBy,

    camelCase,

    toggle (id) {
      this.selectedPermissions = xor(this.selectedPermissions, [id])
    },

    toggleGroup (group) {
      const groupPermissions = this.permissions.filter(p => p.grupo === group)

      if (groupPermissions.every(p => this.selectedPermissions.includes(p.id))) {
        this.selectedPermissions = xor(this.selectedPermissions, groupPermissions.map(p => p.id))
      } else {
        const addablePermissions = groupPermissions.map(p => p.id).filter(id => !this.selectedPermissions.includes(id))
        this.selectedPermissions = xor(this.selectedPermissions, addablePermissions)
      }
    },

    toggleSubgroup (subgroup, group) {
      const subgroupPermissions = this.permissions.filter(p => p.grupo === group).filter(p => p.subgrupo === subgroup)

      if (subgroupPermissions.every(p => this.selectedPermissions.includes(p.id))) {
        this.selectedPermissions = xor(this.selectedPermissions, subgroupPermissions.map(p => p.id))
      } else {
        const addablePermissions = subgroupPermissions.map(p => p.id).filter(id => !this.selectedPermissions.includes(id))
        this.selectedPermissions = xor(this.selectedPermissions, addablePermissions)
      }
    }
  },

  mounted () {
    if (this.role) {
      this.selectedPermissions = this.role.permissions.map(p => p.id).map(p => parseInt(p))
    }

    if (this.oldPermissions.length > 0) {
      this.selectedPermissions = this.oldPermissions.map(p => parseInt(p))
    }

    Object.keys(groupBy(this.permissions, 'grupo')).forEach(key => {
      const safeKey = camelCase(key)
      this.$set(this.collapse, safeKey, false)
      $(`#${safeKey}`).on('show.bs.collapse', () => {
        this.$set(this.collapse, safeKey, true)
      })
      $(`#${safeKey}`).on('hide.bs.collapse', () => {
        this.$set(this.collapse, safeKey, false)
      })
    })
  }
}
</script>
