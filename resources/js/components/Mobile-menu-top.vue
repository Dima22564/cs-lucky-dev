<template>
  <div v-if="getWindowSize <= 1080" class="mobileMenuTop">
    <div class="mobileMenuTop__menu">
      <MenuIcon class="mobileMenuTop__bars icon-30 icon-30-w" />
    </div>
    <div class="mobileMenuTop__bars">
      <PlusIcon @click="showDepositPopup" class="icon-30 icon-30-w" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import PlusIcon from 'vue-material-design-icons/Plus.vue'
import MenuIcon from 'vue-material-design-icons/Menu.vue'
import { eventBus } from '../plugins/event-bus.js'
export default {
  components: {
    PlusIcon,
    MenuIcon
  },
  computed: {
    ...mapGetters({
      getWindowSize: 'common/getWindowSize',
      getNotifications: 'notifications/getNotifications'
    })
  },
  methods: {
    showDepositPopup () {
      eventBus.$emit('depositPopupShow')
    }
  }
}
</script>

<style lang="sass">
.mobileMenuTop
  position: fixed
  left: 0
  top: 0
  width: 100%
  padding: 9px 16px
  display: flex
  align-items: center
  justify-content: space-between
  z-index: 999
  background: #212429
  &__bars
    cursor: pointer
</style>
