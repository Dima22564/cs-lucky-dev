<template>
  <div :class="'notification_' + notificationType" class="notification">
    <div v-if="notificationType === 'success'" class="notification__icon">
      <CheckIcon class="icon" />
    </div>
    <div v-if="notificationType === 'message'" class="notification__icon">
      <MessageIcon class="icon" />
    </div>
    <div v-if="notificationType === 'financial'" class="notification__icon">
      <CardIcon class="icon" />
    </div>
    <div v-if="notificationType === 'warning'" class="notification__icon">
      <AlertIcon class="icon" />
    </div>
    <div class="notification__text">
      <slot />
    </div>
    <div @click="closeNotification" class="notification__close">
      <CloseIcon />
    </div>
  </div>
</template>

<script>
import CheckIcon from 'vue-material-design-icons/Check.vue'
import CloseIcon from 'vue-material-design-icons/Close.vue'
import MessageIcon from 'vue-material-design-icons/MessageOutline.vue'
import CardIcon from 'vue-material-design-icons/CreditCardOutline.vue'
import AlertIcon from 'vue-material-design-icons/Alert.vue'
import { eventBus } from '../plugins/event-bus.js'
export default {
  components: {
    CheckIcon,
    CloseIcon,
    MessageIcon,
    CardIcon,
    AlertIcon
  },
  props: {
    notificationType: {
      type: String,
      required: true
    },
    id: {
      type: String,
      required: true
    }
  },
  methods: {
    closeNotification () {
      eventBus.$emit('closeNotification', this.id)
    }
  }
}
</script>

<style lang="sass">
.notification
  display: flex
  align-items: center
  padding: 16px 24px
  transition: all 0.1s
  cursor: pointer
  &:hover
    background: rgba(224, 224, 255, 0.02)
    .notification__close
      opacity: 1
  &_message
    .notification__icon
      background: rgba(0, 187, 255, 0.03)
      color: #00bbff
  &_financial
    .notification__icon
      background: rgba(255, 0, 170, 0.03)
      color: #ff00aa
  &_success
    .notification__icon
      background: rgba(0, 255, 170, 0.03)
      color: #00ffaa
  &_warning
    .notification__icon
      background: rgba(238, 255, 0, 0.03)
      color: #eeff00
  &__icon
    width: 48px
    height: 48px
    flex-shrink: 0
    border-radius: 50%
    display: flex
    align-items: center
    justify-content: center
    margin-right: 16px
    font-size: 20px
  &__text
    font-size: 14px
    color: rgba(224, 224, 255, 0.6)
    margin-right: 24px
    font-weight: 500
    .blue
      color: #ffaa00
    .white
      color: white
  &__close
    cursor: pointer
    align-self: flex-start
    color: #e0e0ff
    font-size: 15px
    margin-left: auto
    opacity: 0
    transition: all 0.1s
</style>
