<template>
  <div :class="open ? 'faq_active' : ''" class="faq">
    <div
      @click="open ? open = false : open = true"
      class="faq__top"
    >
      <span class="faq__title">{{ title }}</span>
      <PlusIcon v-if="!open" class="icon-30" />
      <MinusIcon v-else class="icon-30" />
    </div>
    <transition name="slide">
      <p
        v-if="open"
        class="faq__text"
      >
        {{ text }}
      </p>
    </transition>
  </div>
</template>

<script>
  import PlusIcon from 'vue-material-design-icons/Plus.vue'
  import MinusIcon from 'vue-material-design-icons/Minus.vue'
  import { mapGetters } from 'vuex'
  export default {
    components: {
      PlusIcon,
      MinusIcon
    },
    computed: {
      ...mapGetters({
        smt: 'faq/smt'
      })
    },
    mounted() {
      console.log(this.smt)
    },
    props: {
      title: {
        type: String,
        required: true
      },
      text: {
        type: String,
        required: true
      }
    },
    data () {
      return {
        open: false,
        displayNone: false
      }
    }
  }
</script>

<style lang="sass">
  @import '../../sass/_var'
  @import '../../sass/_mix'
  .slide-enter-active, .slide-leave-active
    transition: all 0.5s
  .slide-enter, .slide-leave-to
    opacity: 0
  .faq
    padding: 22px 24px
    background-image: linear-gradient(94deg, #2d2f33 1%, #272a2e 52%, #222529)
    border-radius: 24px
    width: 100%
    box-shadow: $dark-shadow
    +lg
      background-image: none
      box-shadow: none
      padding: 16px 32px
      margin-bottom: 16px
    &_active
      box-shadow: $dark-shadow
      background-image: linear-gradient(94deg, #2d2f33 1%, #272a2e 52%, #222529)
    &__top
      display: flex
      align-items: center
      justify-content: space-between
      cursor: pointer
    &__title
      @extend %font-18-24
      font-weight: 500
      margin-bottom: 0
    &__text
      color: rgba(224, 224, 255, 0.6)
      font-weight: 500
      padding-top: 24px
      transition: all 0.2s
      &_none
        display: none
</style>
