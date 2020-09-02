<template>
  <div v-if="popupShow" class="popup__wrapper">
    <div class="popup__body">
      <div class="popup__form">
        <div class="popup__top">
          <p class="popup__title">
            Deposit
          </p>
          <CloseIcon @click="closePopup" class="popup__close" />
        </div>
        <div class="popup__inputWrapper">
          <p class="popup__label">
            Enter the amount in $
          </p>
          <input type="text" class="popup__input">
        </div>

        <div class="popup__btns">
          <button class="popup__btn popup__btn_black">
            Deposit Skins
          </button>
          <button class="popup__btn popup__btn_yellow">
            Deposit Money
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CloseIcon from 'vue-material-design-icons/Close.vue'
import { eventBus } from '../plugins/event-bus.js'
export default {
  components: {
    CloseIcon
  },
  data () {
    return {
      popupShow: false
    }
  },
  created () {
    eventBus.$on('depositPopupShow', () => {
      this.popupShow = true
    })
  },
  methods: {
    closePopup () {
      this.popupShow = false
    }
  }
}
</script>

<style lang="sass">
  @import '../../sass/_mix'
.popup
  &__wrapper
    position: fixed
    top: 0
    left: 0
    width: 100%
    height: 100%
    background-color: rgba(33, 36, 41, 0.96)
    z-index: 99999
  &__body
    width: 100%
    height: 100%
    display: flex
    align-items: center
    justify-content: center
    +md
      align-items: flex-end
  &__form
    border-radius: 24px
    box-shadow: 32px 32px 96px 0 rgba(9, 14, 20, 0.4), -16px -16px 32px 0 rgba(224, 224, 255, 0.04), 0 16px 16px 0 rgba(9, 14, 20, 0.4)
    background-image: linear-gradient(120deg, #2d2f33, #222529)
    padding: 40px
    max-width: 540px
    width: 100%
    +md
      border-radius: 40px 40px 0 0
      padding: 32px
  &__top
    display: flex
    align-items: center
    justify-content: space-between
    margin-bottom: 40px
  &__title
    letter-spacing: -1px
    color: white
    font-size: 36px
    line-height: 36px
    font-weight: bold
  &__inputWrapper
    border-radius: 12px
    padding: 14px 16px
    background-color: rgba(224, 224, 255, 0.02)
    display: flex
    margin-bottom: 40px
    flex-direction: column
    align-items: flex-start
  &__label
    font-size: 13px
    line-height: 16px
    color: rgba(224, 224, 255, 0.4)
    margin-bottom: 7px
  &__input
    font-size: 16px
    line-height: 24px
    color: white
    background: none
    border: none
    padding: 0
  &__close
    color: #e0e0ff
    cursor: pointer
    font-size: 25px
  &__btns
    display: flex
    align-items: center
    justify-content: flex-end
    +md
      justify-content: space-between
  &__btn
    border: none
    padding: 12px 24px
    border-radius: 24px
    font-weight: 600
    font-size: 16px
    line-height: 24px
    color: white
    &_black
      box-shadow: 8px 8px 24px 0 rgba(9, 14, 20, 0.4), -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4)
      background-image: linear-gradient(107deg, #2d2f33 1%, #272a2e 52%, #222529 100%)
      margin-right: 24px
      +md
        margin-right: 0
    &_yellow
      box-shadow: 0 8px 8px -4px rgba(255, 170, 0, 0.12), 0 16px 24px 0 rgba(255, 170, 0, 0.24), 0 2px 4px -1px rgba(10, 70, 82, 0.12), 0 0 1px 0 rgba(255, 170, 0, 0.24)
      background-image: linear-gradient(106deg, #eeff00, #ffaa00 51%, #ff5e00)
</style>
