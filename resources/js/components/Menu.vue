<template>
  <div>
    <transition name="fade">
      <DepositPopup />
    </transition>
    <div v-show="getWindowSize > 1080" class="cs-lucky-container">
      <div class="cs-lucky-menu">
        <div class="cs-lucky-menu__left">
          <router-link tag="div" to="/" class="cs-lucky-menu__logo">
            LOGO
          </router-link>
          <div class="cs-lucky-menu__links">
            <router-link exact to="/" tag="div" class="cs-lucky-menu__link" active-class="cs-lucky-menu__link_active">
              <HomeIcon class="icon icon-30" />
              <span>Home</span>
            </router-link>
            <router-link exact to="/faq" tag="div" class="cs-lucky-menu__link" active-class="cs-lucky-menu__link_active">
              <CommentIcon class="icon icon-30" />
              <span>FAQ</span>
            </router-link>
            <router-link to="/support" tag="div" class="cs-lucky-menu__link" active-class="cs-lucky-menu__link_active" exact>
              <ForumIcon class="icon icon-30" />
              <span>Support</span>
            </router-link>
          </div>

          <div class="cs-lucky-menu__social">
            <a href="" class="cs-lucky-menu__social-link">
              <TelegramIcon />
            </a>
            <a href="" class="cs-lucky-menu__social-link">
              <VkIcon />
            </a>
            <div class="notifications__wrapper">
              <div @click="showNotifications" class="notifications__icon">
                <BellIcon class="icon-30" />
                <span class="notifications__num">{{ getNotifications.length }}</span>
              </div>
              <transition name="fade">
                <div v-if="isNotificationShow" @mouseleave="isNotificationShow = false" class="notifications">
                  <p class="notifications__title">
                    notifications
                  </p>
                  <p v-if="getNotifications.length == 0" class="notifications__none">
                    No notifications
                  </p>
                  <div v-else>
                    <Notification
                      v-for="(item, index) in getNotifications"
                      :key="index"
                      :notification-type="item.type"
                      :id="item.id"
                    >
                      <p><span class="blue">{{ item.blueText }} </span>sent you <span class="white"> {{ item.whiteText }}</span></p>
                    </Notification>
                  </div>
                </div>
              </transition>
            </div>
          </div>
        </div>

        <div class="cs-lucky-menu__right">
          <transition name="fade">
            <div v-if="isAccountShow && !isEmpty(getUser)" @mouseleave="isAccountShow = false" class="account__drop">
              <p class="account__name">
                {{ getUser.username }}
              </p>
              <router-link class="account__link" to="/dashboard" tag="div">
                <UserIcon class="icon" />
                <span>Profile</span>
              </router-link>
              <button @click.prevent="logout" class="account__link account__link_logout" to="/signout" tag="div">
                <LogoutIcon class="icon" />
                <span>Sign Out</span>
              </button>
            </div>
          </transition>
          <div v-if="!isEmpty(getUser)" @click="isAccountShow ? isAccountShow = false : isAccountShow = true" class="cs-lucky-menu__right-2">
            <img :src="getUser.avatar" alt="" class="cs-lucky-menu__avatar">
            <div class="cs-lucky-menu__wrapper">
              <div class="cs-lucky-menu__text">
                <p class="cs-lucky-menu__name">
                  {{ getUser.username }}
                </p>
                <p class="cs-lucky-menu__balance">
                  Balance: <span class="emp">${{ getUser.balance }}</span>
                </p>
              </div>
            </div>
          </div>
          <div v-else class="cs-lucky-menu__login">
            <a href="/auth/steam" class="cs-lucky-menu__steam">
              <SteamIcon class="icon" />
            </a>
            <div class="cs-lucky-menu__textSteam">
              <span class="emp">login through</span>
              <span class="yellow">STEAM</span>
            </div>
          </div>
          <button @click="showDepositPopup" class="cs-lucky-menu__add">
            <PlusIcon />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
import HomeIcon from 'vue-material-design-icons/Home.vue'
import CommentIcon from 'vue-material-design-icons/CommentQuestion.vue'
import ForumIcon from 'vue-material-design-icons/Forum.vue'
import TelegramIcon from 'vue-material-design-icons/Telegram.vue'
import VkIcon from 'vue-material-design-icons/Vk.vue'
import BellIcon from 'vue-material-design-icons/Bell.vue'
import PlusIcon from 'vue-material-design-icons/Plus.vue'
import { eventBus } from '../plugins/event-bus.js'
import DepositPopup from './Deposit-popup'
import Notification from './Notification'
import SteamIcon from 'vue-material-design-icons/Steam.vue'
import UserIcon from 'vue-material-design-icons/Account.vue'
import LogoutIcon from 'vue-material-design-icons/Logout.vue'
export default {
  data () {
    return {
      isNotificationShow: false,
      isAccountShow: false
    }
  },
  computed: {
    ...mapGetters({
      getWindowSize: 'common/getWindowSize',
      getNotifications: 'notifications/getNotifications',
      getUser: 'user/getUser'
    })
  },
  async mounted () {
    const that = this
    this.windowSize = window.innerWidth
    this.setWindowSize(window.innerWidth)
    window.addEventListener('resize', function () {
      const windowSize = window.innerWidth
      that.setWindowSize(windowSize)
    })
    await this.$store.dispatch('user/loadUser')
  },
  created () {
    eventBus.$on('closeNotification', (id) => {
      this.$store.commit('notifications/deleteNotification', id)
    })
  },
  methods: {
    ...mapMutations({
      setWindowSize: 'common/setWindowSize',
    }),
    isEmpty(obj) {
  for (let key in obj) {
    // если тело цикла начнет выполняться - значит в объекте есть свойства
    return false;
  }
  return true;
},
    showNotifications () {
      // this.isLangsShow = false
      this.isNotificationShow = this.isNotificationShow !== true;
      // this.isAccountShow = false
      // this.isFinancialShow = false
      // this.isMobileMainMenuShow = false
    },
    showDepositPopup () {
      eventBus.$emit('depositPopupShow')
    },
    async logout () {
      await this.$store.dispatch('user/logout')
    }
  },
  components: {
    HomeIcon,
    CommentIcon,
    ForumIcon,
    TelegramIcon,
    VkIcon,
    BellIcon,
    PlusIcon,
    Notification,
    DepositPopup,
    SteamIcon,
    UserIcon,
    LogoutIcon
  }
}
</script>

<style lang="sass">
@import '../../sass/_var'
.cs-lucky-menu
  display: flex
  align-items: center
  border-bottom: 2px solid rgba(224, 224, 255, 0.06)
  margin: 0 0 0 -20px
  padding: 0 0 0 20px
  &__left
    padding-top: 24px
    display: flex
    align-items: flex-start
    width: 100%
  &__right
    max-width: 352px
    width: 100%
    background: #272a2e
    display: flex
    align-items: center
    padding: 16px 24px 16px 16px
    position: relative
    &-2
      display: flex
      align-items: center
      position: relative
      cursor: pointer
  &__login
    display: flex
    align-items: center
  &__steam
    width: 64px
    height: 64px
    border-radius: 24px
    box-shadow: 8px 8px 24px 0 rgba(9, 14, 20, 0.4), -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4)
    background: linear-gradient(135deg, #2d2f33 1%, #272a2e 52%, #222529)
    border: none
    display: flex
    align-items: center
    margin-right: 24px
    justify-content: center
    .icon
      color: rgba(224, 224, 255, 0.6)
  &__textSteam
    .emp
      font-size: 20px
      line-height: 28px
      letter-spacing: -0.4px
      font-weight: 600
      color: white
    .yellow
      font-size: 14px
      line-height: 24px
      color: #ffaa00
      font-weight: 600
  &__avatar
    border-radius: 50%
    flex-shrink: 0
    margin-right: 24px
    width: 64px
    height: 64px
  &__logo
    margin-right: 48px
  &__links
    display: flex
    align-items: center
  &__link
    display: flex
    align-items: center
    color: $gray
    cursor: pointer
    font-size: 16px
    padding-bottom: 34px
    position: relative
    user-select: none
    &:not(:last-child)
      margin-right: 48px
    &_active
      color: $white
      &::after
        width: 100%
        content: ''
        background: $main-color
        position: absolute
        height: 2px
        bottom: 0
        left: 0
      .icon
        color: $main-color
    .icon
      margin-right: 15px
  &__social
    display: flex
    align-items: center
    margin-right: 24px
    margin-left: auto
    &-link
      color: $gray
      &:not(:last-child)
        margin-right: 48px
  &__wrapper
    display: flex
    align-items: center
    margin-right: 24px
  &__name
    font-size: 20px
    line-height: 28px
    letter-spacing: -0.4px
  &__balance
    color: $gray
    .emp
      color: $white
  &__add
    @extend %btn-refresh
    display: flex
    align-items: center
    justify-content: center
    width: 48px
    height: 48px
    border-radius: 50%
    flex-shrink: 0
    margin-left: auto
    color: $white
    background-image: $main-gradient
    box-shadow: $main-shadow
.notifications
  &__icon
    cursor: pointer
    position: relative
  &__wrapper
    position: relative
  &__num
    color: $white
    @extend %font-13-16
    display: inline-block
    padding: 0 3px
    background: $main-color
    border-radius: 9px
    position: absolute
    top: -10px
    right: -10px
.fade-enter-active, .fade-leave-active
  transition: opacity .5s
.fade-enter, .fade-leave-to
  opacity: 0
.account
  position: relative
  &__icon
    display: flex
    align-items: center
    color: rgba(224, 224, 255, 0.4)
    font-size: 21px
    cursor: pointer
  &__img
    width: 48px
    height: 48px
    border-radius: 50%
    flex-shrink: 0
    margin-right: 8px
  &__drop
    border-radius: 24px
    box-shadow: 16px 16px 48px 0 rgba(9, 14, 20, 0.4), -8px -8px 16px 0 rgba(224, 224, 255, 0.04), 0 8px 8px 0 rgba(9, 14, 20, 0.4)
    background-image: linear-gradient(123deg, #2d2f33, #222529 100%)
    background-color: #27273e
    z-index: 55
    position: absolute
    left: 0
    bottom: 0
    transform: translateY(calc(100%))
    min-width: 255px
    padding: 16px 0
  &__name
    padding: 0 16px
    text-transform: uppercase
    font-size: 14px
    color: rgba(224, 224, 255, 0.6)
    font-weight: 600
    margin-bottom: 24px
  &__arrow
    transition: all 0.2s
    &_rotate
      transform: rotate(180deg)
  &__link
    padding: 9px 20px
    color: white
    font-size: 14px
    font-weight: 500
    cursor: pointer
    user-select: none
    &_logout
      margin-top: 16px
      background: none
      border: none
      width: 100%
      text-align: left
    &:hover
      background: rgba(224, 224, 255, 0.02)
    .icon
      color: #e0e0ff
      opacity: 0.6
      margin-right: 5px
.notifications
  position: absolute
  right: 0
  bottom: 0
  transform: translateY(calc(100% + 8px))
  min-width: 328px
  border-radius: 12px
  box-shadow: $dark-shadow
  background-image: linear-gradient(140deg, #2d2f33, #222529)
  z-index: 10
  padding: 16px 0
  &__none
    color: rgba(224,224,255,.6)
    font-weight: 600
    font-size: 16px
    width: 100%
    text-align: center
  &__count
    font-size: 13px
    line-height: 16px
    color: white
    background: #00bbff
    position: absolute
    top: 0
    right: 0
    padding: 1px 4px
    border-radius: 12px
  &__title
    text-transform: uppercase
    margin-bottom: 24px
    font-size: 14px
    font-weight: 600
    color: rgba(224, 224, 255, 0.6)
    letter-spacing: 1px
    padding: 0 16px
</style>
