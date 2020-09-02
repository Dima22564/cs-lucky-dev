<template>
  <div class="cs-lucky-main cs-lucky-main-faqs">
    <div class="cs-lucky-container">
      <div class="cs-lucky-row">
        <div class="faqs-content">
          <div v-bar="{ preventParentScroll: true }">
            <div class="faqs__wrapper">
              <div class="faqs">
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
                <Faq class="faqs__faq" title="Chat rules" text="It is not allowed, if you use more than 1 account at the same time . One of the reasons is about using promo codes and stealing them from other people. For the use of multiple accounts, some measures may be applied: Promo codes bans, Deleting items, Withdrawal bans"></Faq>
              </div>
            </div>
            <div class="faqs__bg"></div>
          </div>
          <cs-lucky-footer></cs-lucky-footer>
        </div>
        <chat class="mobileChat"></chat>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapMutations } from 'vuex'
  import Chat from '../components/Chat'
  import Footer from '../components/Footer'
  import Faq from '../components/faq'
  export default {
    layout: 'default',
    components: {
      Chat,
      Footer,
      Faq
    },
    mounted () {
      this.changeTabStore(null)
    },
    methods: {
      ...mapMutations({
        changeTabStore: 'common/changeTab'
      })
    }
  }
</script>
