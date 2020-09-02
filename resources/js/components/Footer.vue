<template>
  <footer class=footer>
    <span>Copyright © 2020 CSlucky. All rights reserved.</span>
    <nuxt-link class="footer__link" to="/terms" tag="span">Terms of Service</nuxt-link>
    <nuxt-link class="footer__link" to="/fair" tag="span">Probably Fair</nuxt-link>
    <span>made by <a class="footer__link emp" href="">roobinium</a></span>
  </footer>
</template>

<script>
export default {

}
</script>

<style lang="sass">
  @import '../../sass/_mix'
.footer
  margin: 8px 0
  padding: 16px 12px
  display: flex
  align-items: center
  justify-content: space-between
  color: rgba(224, 224, 255, 0.6)
  font-weight: 500
  +lg
    display: none
  &__link
    cursor: pointer
  .emp
    color: white
</style>
