<template>
  <div :class="my ? 'message_my' : ''" class="message">
    <img :src="avatar" alt="" class="message__img">
    <div class="message__text">
      <p class="message__info">
        <span class="name">{{ name }}</span>
        <span class="name">{{ time }}</span>
      </p>
      <p class="message__message">
        {{ message }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    avatar: {
      type: String,
      required: true
    },
    time: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    message: {
      type: String,
      required: true
    },
    my: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="sass">
  @import '../../sass/_var'
.message
  margin-bottom: 24px
  box-shadow: $dark-shadow
  background-image: linear-gradient(103deg, #2d2f33 1%, #272a2e 52%, #222529)
  padding: 16px
  display: flex
  border-radius: 24px
  &_my
    background: $main-color
    box-shadow: none
    .message__info
      color: rgba(255, 255, 255, 0.6)
  &__img
    width: 36px
    height: 36px
    border-radius: 12px
    margin-right: 16px
    flex-shrink: 0
  &__text
    width: 100%
  &__info
    display: flex
    align-items: center
    justify-content: space-between
    color: rgba(224, 224, 255, 0.4)
    @extend %font-10-12
    margin-bottom: 6px
    font-weight: 500
  &__message
    font-weight: 500
    @extend %font-13-16
</style>
