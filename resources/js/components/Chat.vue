<template>
  <div class="chat">
    <div v-bar="{ preventParentScroll: true }">
      <div class="chat__messages">
        <div class="chat__wrapper-2">
          <Message 
            v-for="message in messages"
            :key="message.id"
            :message="message.message"
            :time="message.created_at"
            :name="message.user.name"
            :avatar="'dsdf'"
            :my="getUser.id === message.user.id"
          />
        </div>
      </div>
    </div>

    <form class="chat__input" @submit.prevent="sendMessage">
      <input v-model="message" type="text" placeholder="Write your message…">
      <button>
        <ArrowUpIcon class="icon-30" />
      </button>
    </form>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex'
import ArrowUpIcon from 'vue-material-design-icons/ArrowUp.vue'
import Message from './Message'
export default {
  components: {
    Message,
    ArrowUpIcon
  },
  data () {
    return {
      message: '',
      messages: []
    }
  },
  computed: {
      ...mapGetters({
        getUser: 'user/getUser',
      })
    },
  created () {
    window.Echo.channel('public-chat')
      .listen('Message', (e) => {
        console.log(e)
        this.messages.push(e.message)
        this.message = ''
      })
    this.fetchMessages()

  },
  methods: {
    sendMessage () {
      try {
        axios.post('/public-chat', { message: this.message, user_id: 1 })
      } catch (error) {
        console.log(error)
      }
    },
    async fetchMessages () {
      try {
        const { data } = await axios.get('/get-public-chat')
        this.messages = data
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>

<style lang="sass">
  @import '../../sass/_var'
  @import '../../sass/_mix'
.chat
  max-width: 352px
  width: 100%
  background: #272a2e
  border-bottom-left-radius: 40px
  height: 100%
  flex-shrink: 0
  margin: -24px 0 -24px -24px
  padding: 24px 0 24px 24px
  height: calc(100vh - 88px)
  display: flex
  flex-direction: column
  justify-content: space-between
  +lg
    height: calc(100vh - 48px - 82px - 14px)
    max-width: 100%
    margin: 0 auto 0 auto
    padding: 0
    background: transparent
    position: relative
    .vb
      +lg
        margin-right: -20px
  &__wrapper-2
    // padding-right: 30px
  &__messages
    overflow-y: scroll
    height: calc(100% - 40px)
    margin-right: -24px
    padding-right: 24px
  &__input
    display: flex
    align-items: center
    margin-top: auto
    input
      border: none
      background: transparent
      color: $white
      font-size: 14px
      line-height: 20px
      width: 100%
      margin-right: 16px
    button
      color: $white
      font-weight: 500
      @extend %btn-refresh
      &::placeholder
        color: rgba(224, 224, 255, 0.6)
</style>
