<template>
  <div v-if="getWindowSize <= 1080" class="mobileMenuBottom">
    <div @click="changeTab('game')" :class="getCurrentTab === 'game' ? 'mobileMenuBottom__item_active' : ''" class="mobileMenuBottom__item">
      <HomeIcon />
      <span>Game</span>
    </div>
    <div @click="changeTab('inventory')" :class="getCurrentTab === 'inventory' ? 'mobileMenuBottom__item_active' : ''" class="mobileMenuBottom__item">
      <HomeIcon />
      <span>Inventory</span>
    </div>
    <div @click="changeTab('bets')" :class="getCurrentTab === 'bets' ? 'mobileMenuBottom__item_active' : ''" class="mobileMenuBottom__item">
      <HomeIcon />
      <span>Bets</span>
    </div>
    <div @click="changeTab('chat')" :class="getCurrentTab === 'chat' ? 'mobileMenuBottom__item_active' : ''" class="mobileMenuBottom__item">
      <MessageIcon />
      <span>Chat</span>
    </div>
    <router-link to="/account" tag="div" active-class="mobileMenuBottom__item_active" class="mobileMenuBottom__item">
      <AccountIcon />
      <span>Profile</span>
    </router-link>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
import HomeIcon from 'vue-material-design-icons/Home.vue'
import MessageIcon from 'vue-material-design-icons/Message.vue'
import AccountIcon from 'vue-material-design-icons/Account.vue'
export default {
  components: {
    HomeIcon,
    MessageIcon,
    AccountIcon
  },
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters({
      getWindowSize: 'common/getWindowSize',
      getCurrentTab: 'common/getCurrentTab'
    })
  },
  methods: {
    changeTab (tab) {
      if (this.$route !== '/') {
        this.changeTabStore(tab)
        this.$router.push('/')
      } else {
        this.changeTabStore(tab)
      }
    },
    ...mapMutations({
      changeTabStore: 'common/changeTab'
    })
  }
}
</script>

<style lang="sass">
.mobileMenuBottom
  position: fixed
  left: 0
  bottom: 0
  width: 100%
  z-index: 999
  box-shadow: -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4)
  background-color: #272a2e
  padding-bottom: 32px
  padding-top: 10px
  display: flex
  &__item
    width: 20%
    display: flex
    flex-direction: column
    align-items: center
    justify-content: center
    color: rgba(224, 224, 255, 0.24)
    cursor: pointer
    &_active
      color: #ffaa00
    span
      font-size: 10px
      line-height: 16px
</style>
