<template>
  <div class="historyItem">
    <img :src="avatar" alt="" class="historyItem__avatar">
    <div class="historyItem__wrapper">
      <button v-if="items.length > 3" class="historyItem__circle">
        3+
      </button>
      <div class="historyItem__weapons">
        <div v-for="(item, index) in items" :key="index" class="historyItem__weaponWrapper">
          <img :src="item" alt="" class="historyItem__weapon">
        </div>
      </div>
    </div>

    <div class="historyItem__right">
      <div class="historyItem__info">
        ${{ cost }}
      </div>
      <div class="historyItem__info historyItem__info_green">
        {{ coeff }}x
      </div>
      <div class="historyItem__info historyItem__info_l-green">
        ${{ cost2 }}
      </div>
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
    items: {
      type: Array,
      required: true
    },
    cost: {
      type: Number,
      required: true
    },
    cost2: {
      type: Number,
      required: true
    },
    coeff: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="sass">
@import '../../sass/_var'
@import '../../sass/_mix'
.historyItem
  background-image: linear-gradient(96deg, #2d2f33 1%, #272a2e 52%, #222529)
  box-shadow: $dark-shadow
  border-radius: 24px
  padding: 12px
  display: flex
  align-items: center
  // width: calc(100% + 17px)
  margin-right: 18px
  &:not(:last-child)
    margin-bottom: 24px
    +lg
      margin-bottom: 16px
  &:last-child
    margin-bottom: 70px
    +lg
      margin-bottom: 50px
  &__avatar
    width: 48px
    height: 48px
    border-radius: 12px
    margin-right: 12px
    flex-shrink: 0
  &__con
    position: relative
  &__weapons
    display: flex
    align-items: center
    max-width: 216px
    position: relative
    overflow: hidden
  &__weaponWrapper
    border-radius: 12px
    background-color: rgba(224, 224, 255, 0.02)
    display: flex
    align-items: center
    justify-content: center
    width: 64px
    height: 48px
    flex-shrink: 0
    &:not(:last-child)
      margin-right: 12px
  &__wrapper
    margin-right: 38px
    position: relative
    +media(1330)
      display: none
  &__weapon
    width: 70%
  &__circle
    width: 24px
    height: 24px
    border-radius: 50%
    box-shadow: 8px 8px 24px 0 rgba(9, 14, 20, 0.4), -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4), inset 0 -2px 1px 0 rgba(9, 14, 20, 0.8)
    background-image: linear-gradient(to bottom, #383a3d, #2d2f33)
    @extend %font-13-16
    color: $white
    position: absolute
    @extend %btn-refresh
    top: 0
    right: 0
    z-index: 5
    transform: translate(50%, 50%)
  &__right
    margin-left: auto
    display: flex
    align-items: center
  &__info
    padding: 6px 21px
    border-radius: 12px
    margin-right: 18px
    font-size: 14px
    font-weight: bold
    color: $white
    &_green
      background: #16b862
    &_l-green
      background-color: rgba(0, 255, 170, 0.06)
      color: #00ffaa
</style>
