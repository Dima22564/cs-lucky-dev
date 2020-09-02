<template>
  <main class="cs-lucky-main">
    <div class="cs-lucky-container">
      <div class="cs-lucky-row">
        <div class="cs-lucky-main--left">
          <div ref="nb" @click="updateMultiplier"
               v-if="(getCurrentTab === 'game' && getWindowSize < 1080) || getWindowSize >= 1080" class="graph">
            <apexchart ref="csLuckyChart" :options="chartOptions" :series="series" height="100%"></apexchart>
            <div class="graph__bg" @click.prevent.once="t" v-show="getGameStatus === 0">
              <number
                ref="prepareForGame"
                :from="getTimeForNewGame"
                :to="0.0"
                :format="theFormat"
                :duration="getTimeForNewGame"
                :animationPaused="animationPaused"
                @complete="gameStart"
                easing="Power0.easeNone"
               />s
            </div>
             <div class="graph__bg" :class="getGameStatus === 2 ? 'graph__bg_crashed' : ''" v-show="getGameStatus === 1 || getGameStatus === 2">
              <number
                ref="gameStart"
                :from="1"
                :to="getMultiplier"
                :format="gameMultiplierFormat"
                :duration="getDuration"
                :animationPaused="animationPaused"
                easing="Power1.easeIn"
               />x
            </div>
          </div>

          <div v-if="(getCurrentTab === 'bets' && getWindowSize < 1080) || getWindowSize >= 1080" class="players">
            <div class="players__item players__item_yellow">
              <div class="players__icon">
                <LayerIcon class="icon icon-30-w"/>
              </div>
              <div class="players__text">
                <p class="num">
                  238.55
                </p>
                <p class="text">
                  Value
                </p>
              </div>
            </div>
            <div class="players__item players__item_pink">
              <div class="players__icon">
                <UserIcon class="icon icon-30-w"/>
              </div>
              <div class="players__text">
                <p class="num">
                  238.55
                </p>
                <p class="text">
                  Value
                </p>
              </div>
            </div>
          </div>

          <div v-if="(getCurrentTab === 'inventory' && getWindowSize < 1080) || getWindowSize >= 1080" class="choose">
            <div class="choose__top">
              <span class="choose__num">$6.99</span>
              <div class="choose__toggler">
                <span class="choose__label">All</span>
                <div :class="all ? 'toggler_active' : ''" @click="all === true ? all = true : all = false"
                     class="toggler">
                  <label for="sound" class="toggler__label">
                    <div class="toggler__circle"/>
                    <div class="toggler__way"/>
                  </label>
                  <input id="sound" v-model="all" type="checkbox" name="sound" class="toggler__input">
                </div>
              </div>
            </div>

            <div v-bar="{preventParentScroll: true}" class="choose__items">
              <div class="choose__items-3">
                <div class="choose__items-2">
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                  <div class="choose__item">
                    <div class="choose__item-top">
                      <span class="choose__item-title">
                        FAMAS
                      </span>
                      <span class="choose__item-circle"/>
                    </div>
                    <img class="choose__item-img" src="/images/item.png" alt="">

                    <div class="choose__item-bottom">
                      <span class="text">Factorthrfhrtg</span>
                      <span class="num">$130.00</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="cs-lucky-main--center">
          <div v-if="(getCurrentTab === 'game' && getWindowSize < 1080) || getWindowSize >= 1080" class="knife">
            <div class="knife__left">
              <img src="images/knife.png" alt="">
            </div>
            <div class="knife__right">
              <div class="knife__line">
                <p class="text">
                  296<span class="emp">.72</span>
                </p>
                <RightIcon class="arrow"/>
                <p class="text">
                  296<span class="emp">.72</span>
                </p>
              </div>

              <div class="knife__coeffs">
                <span class="coeff">
                  x1.1
                </span>
                <span class="coeff">
                  x1.1
                </span>
                <span class="coeff coeff_active">
                  x1.1
                </span>
                <span class="coeff">
                  x1.1
                </span>
              </div>

              <div class="knife__btns">
                <button class="knife__btn-1">
                  2.0
                </button>
                <button class="knife__btn-2" v-if="getGameStatus === 1 || getGameStatus === 2">
                  <span>Receive</span>
                  <span>x{{ multiplierSend }}</span>
                </button>
                <button @click.prevent="makeBet" class="knife__btn-2" v-if="getGameStatus === 0">
                  <span>Start</span>
                  <span>14862</span>
                </button>
              </div>
            </div>
          </div>

          <div v-if="(getCurrentTab === 'game' && getWindowSize < 1080) || getWindowSize >= 1080" class="coeffs">
            <slick :options="sliderOptions">
              <div class="coeffs__item">
                <button class="coeffs__coeff">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item coeffs__item_green">
                <button class="coeffs__coeff coeffs__coeff_red">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_green">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_blue">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_red">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_red">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_red">
                  1.58x
                </button>
              </div>
              <div class="coeffs__item">
                <button class="coeffs__coeff coeffs__coeff_red">
                  1.58x
                </button>
              </div>
            </slick>
          </div>

          <div v-if="(getCurrentTab === 'bets' && getWindowSize < 1080) || getWindowSize >= 1080" class="history__con">
            <div class="history__bg"/>
            <div v-bar="{preventParentScroll: true}" class="history">
              <div>
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
                <history
                  :cost="12.2"
                  :cost2="15.2"
                  :coeff="2.30"
                  :items="['/images/it-1.png', '/images/it-2.png', '/images/it-3.png', 'fergfe']"
                  avatar="/images/avatar-2.png"
                />
              </div>
            </div>
          </div>
        </div>

        <Chat v-if="(getCurrentTab === 'chat' && getWindowSize < 1080) || getWindowSize >= 1080"/>
      </div>
    </div>
  </main>
</template>

<script>
  import {mapGetters, mapMutations} from 'vuex'
  import LayerIcon from 'vue-material-design-icons/Layers.vue'
  import UserIcon from 'vue-material-design-icons/Account.vue'
  import RightIcon from 'vue-material-design-icons/ChevronDoubleRight.vue'
  import Chat from '../components/Chat'
  import History from '../components/History'
  import apexchart from 'vue-apexcharts'
  import hmacSHA512 from 'crypto-js/hmac-sha256'
  import aes from 'crypto-js/aes'

  export default {
    components: {
      LayerIcon,
      UserIcon,
      Chat,
      History,
      RightIcon,
      apexchart,
    },
    data() {
      return {
        currentTab: 'game',
        all: '',
        multiplier: [],
        xMulti: [],
        tabs: [
          'game',
          'inventory',
          'bets',
          'chat'
        ],
        multiplierSend: 1,
        animationPaused: true,
        counter: 1,
        sliderOptions: {
          slidesToShow: 7,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          variableWidth: true,
          infinite: false
        },
        series: [{
          name: 'series1',
          data: []
        }],
        chartOptions: {
          chart: {
            id: 'csLuckyChart',
            // height: 228,
            type: 'area',
            height: '100%',
            zoom: {
              enabled: false,
              autoScaleYaxis: true,
              type: 'xy'
            },
            dynamicAnimation: {
              enabled: true,
              speed: 450
            },
            // brush: {
            //   target: 'csLuckyChart',
            //   autoScaleYaxis: true
            // }
          },
          dataLabels: {
            enabled: false,
            style: {
              colors: ['rgba(224, 224, 255, 0.4)']
            }
          },
          stroke: {
            curve: 'smooth',
            colors: ['#ffaa00']
          },
          xaxis: {
            type: 'datetime',
            categories: [],
            axisTicks: {
              show: false
            },
            axisBorder: {
              show: false
            },
            labels: {
              show: false
            },
            min: 1
          },
          yaxis: {
            min: 1,
            showForNullSeries: true,
            // logarithmic: true,
            forceNiceScale: true,
            decimalsInFloat: 2,
            labels: {
              style: {
                colors: ['rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)', 'rgba(224, 224, 255, 0.4)']
              }
            }
          },
          markers: {
            size: 0,
            strokeColor: '#ffaa00',
            colors: 'rgba(224, 224, 255, 0.4)'
          },
          colors: ['#ffaa00'],
          fill: {
            type: 'gradient',
            colors: '#ffaa00',
            gradient: {
              opacityFrom: 0.8,
              opacityTo: 0.2
            }
          },
          grid: {
            row: {
              colors: ['rgba(224, 224, 255, 0.001)']
            },
            column: {
              colors: ['rgba(224, 224, 255, 0.001)']
            }
          },
          tooltip: {
            enabled: false
          }
        }
      }
    },
    computed: {
      ...mapGetters({
        getWindowSize: 'common/getWindowSize',
        getCurrentTab: 'common/getCurrentTab',
        getTimeForNewGame: 'game/getTimeForNewGame',
        getGameStatus: 'game/getGameStatus',
        getDuration: 'game/getDuration',
        getMultiplier: 'game/getMultiplier'
      }),
    },
    async mounted() {
      // console.log(window.Echo.connector.socket.emit)
      // console.log(hmacSHA512(`fdfgdfgdf`, process.env.MIX_SECRET_KEY).toString())
      const a = aes.encrypt('5', process.env.MIX_SECRET_KEY)
      console.log(aes.decrypt(a, process.env.MIX_SECRET_KEY).toString())
      // console.log(process.env.MIX_SECRET_KEY)
      window.Echo.channel('game')
        .listen('GamePrepare', ({ game }) => {
          this.$refs.prepareForGame.restart()
          this.$refs.gameStart.restart()
          this.$refs.gameStart.pause()
          this.setGameId(game.id)
          this.setGameHash(game.hash)
          this.setGameStatus(game.status)
          this.setDuration(game.duration)
          this.setMultiplier(game.multiplier)
          console.log(game)
        })
        .listen('GameStart', ({ game }) => {
          this.setGameStatus(1)
          this.$refs.gameStart.restart()
          this.$refs.prepareForGame.pause()
          console.log(game)
        })
        .listen('GameEnd', () => {
          this.setGameStatus(2)
          setTimeout(() => {
            this.$refs.gameStart.restart()
            this.$refs.gameStart.pause()
          }, 5500);
        })
      
      // const data = await axios.get('/start')


      // console.log(data)
    //   await axios.post('/make-bet', {
    //     "betItems": [
    //     {
    //         "cost": 25,
    //         "item_id": 12
    //     },
    //     {
    //         "cost": 25,
    //         "item_id": 12
    //     }
    // ]
    //   })
    },
    methods: {
      ...mapMutations({
        gameChangeState: 'game/gameChangeState',
        setGameId: 'game/setGameId',
        setGameHash: 'game/setGameHash',
        setGameStatus: 'game/setGameStatus',
        setDuration: 'game/setDuration',
        setMultiplier: 'game/setMultiplier'
      }),
      async gameStart () {
        // await this.$store.dispatch('game/gameStart')
      },
      async makeBet () {
        await this.$store.dispatch('game/makeBet')
      },
      async t () {
        await axios.get('/game-prepare')
      },
      theFormat(number) {
        return number.toFixed(1);
      },
      gameMultiplierFormat(number) {
        this.multiplierSend = number.toFixed(2)
        return number.toFixed(2)
      },
      updateMultiplier() {
        // const multiplier = []
        // const xDate = []
        // console.log(this)
        // let i = 1
        // let timer = setInterval(() => {
        //   multiplier.push(i)
        //   i += 0.01
        //   let d = new Date().getTime() + Math.random() * 1000
        //   xDate.push(d)
        //   if (i === 150) {
        //     clearInterval(timer)
        //     console.log(multiplier)
        //   }
        //   console.log(xDate)
        //   this.$refs.csLuckyChart.updateOptions({
        //     xaxis: {
        //       categories: xDate
        //     }
        //   })
        //   this.$refs.csLuckyChart.updateSeries([{
        //     data: multiplier
        //   }])
        //  }, 650)
      }
    }
  }
</script>

<style lang="sass">
  @import '../../sass/_var'
  @import '../../sass/_mix'
  .cs-lucky-main
    padding: 24px 0 0
    +lg
      padding: 0

    &--left
      max-width: 356px
      width: 100%
      flex-shrink: 0
      +lg
        max-width: 100%

    &--center
      padding-left: 15px
      padding-right: 40px
      width: calc(100% - 332px - 352px - 24px)
      +lg
        max-width: 100%
        width: 100%
        padding: 0

  .apexcharts-toolbar
    display: none !important

  .players
    display: flex
    justify-content: space-between
    margin-bottom: 24px
    +lg
      margin-bottom: 32px

    .num
      @extend %font-18-24
      letter-spacing: -0.4px
      font-weight: bold

    .text
      @xtend %font-13-16
      color: $dark-white

    &__item
      width: calc(50% - 12px)
      color: $white
      padding: 12px 30px 12px 16px
      border-radius: 24px
      display: flex
      align-items: center
      justify-content: space-between

      &_yellow
        background: $main-gradient
        box-shadow: $main-shadow

      &_pink
        box-shadow: $secondary-shadow
        background: $secondary-gradient

    &__text
      margin-left: 16px

    &__icon
      width: 40px
      height: 40px
      flex-shrink: 0
      display: flex
      align-items: center
      justify-content: center
      border-radius: 12px
      +white(0.06, 'bg')

  .choose
    padding: 24px 0 24px 24px
    background-image: $dark-gradient
    box-shadow: $dark-shadow
    border-radius: 24px
    height: calc(100vh - 482px)
    overflow: hidden
    +lg
      height: calc(100vh - 54px - 82px - 16px)

    .toggler__way
      width: 40px

    &__label
      margin-right: 16px
      font-size: 13px
      line-height: 16px
      color: rgba(224, 224, 255, 0.6)

    &__top
      display: flex
      align-items: center
      justify-content: space-between
      margin-bottom: 24px
      padding-right: 24px

    &__num
      @extend %font-18-24
      letter-spacing: -0.4px
      font-weight: bold

    &__toggler
      display: flex
      align-items: center

    &__items
      overflow-y: hidden
      height: calc(100% - 45px)
      background: $dark-gradient

      &-2
        display: flex
        justify-content: space-between
        flex-wrap: wrap
        overflow: hidden
        padding-right: 0
        +lg
          padding-right: 24px

      &-3
        padding-right: 24px !important

    &__item
      width: calc(50% - 12px)
      border-radius: 12px
      background-color: rgba(224, 224, 255, 0.02)
      margin-bottom: 24px
      display: flex
      flex-direction: column
      +lg
        width: calc(25% - 12px)
      +md
        width: calc(50% - 12px)

      &-img
        width: 70%
        margin: 10px auto

      &-top
        display: flex
        align-items: center
        justify-content: space-between
        margin-bottom: 12px
        padding: 12px

      &-title
        @extend %font-10-12

      &-circle
        width: 12px
        height: 12px
        border-radius: 50%
        background: #c32de1

      &-bottom
        display: flex
        align-items: center
        justify-content: space-between
        padding: 12px
        @extend %font-10-12
        +white(0.4, 'c')

        .num
          margin-left: 12px
          @extend %font-13-16
          font-weight: bold
          color: $white

        .text
          overflow: hidden
          text-overflow: ellipsis

  .coeffs
    background-image: linear-gradient(96deg, #2d2f33 1%, #272a2e 52%, #222529)
    border-radius: 24px
    padding: 12px
    margin-bottom: 24px
    box-shadow: $dark-shadow

    .slick-slide
      margin-right: 12px

    &__coeff
      @extend %btn-refresh
      font-size: 16px
      line-height: 24px
      padding: 10px 16px
      border-radius: 12px
      border: solid 2px #c32de1
      background-color: rgba(195, 45, 225, 0.06)
      color: $white
      font-weight: bold

      &_red
        border: solid 2px #ff00aa
        background-color: rgba(255, 0, 170, 0.06)

      &_green
        border: solid 2px #00ffaa
        background-color: rgba(0, 255, 170, 0.06)

      &_blue
        border: solid 2px #00bbff
        background-color: rgba(0, 187, 255, 0.06)

  .history
    height: calc(100vh - 72px - 72px - 120px - 228px)
    overflow-y: auto
    margin: 0 0 0 -43px
    padding: 0 0 0 43px
    position: relative
    +lg
      height: calc(100vh - 48px - 32px - 82px - 72px - 16px)
      margin-right: -6px

    &__con
      position: relative

    &__bg
      background-image: linear-gradient(to bottom, rgba(33, 36, 41, 0), #212429)
      position: absolute
      bottom: 0
      left: 0
      width: 100%
      height: 50px
      z-index: 5
      +lg
        height: 80px

  .graph
    background-image: linear-gradient(124deg, #2d2f33 1%, #272a2e 52%, #222529 100%)
    border-radius: 24px
    margin-bottom: 24px
    box-shadow: $dark-shadow
    height: 228px
    position: relative
    +lg
      margin-bottom: 16px
    &__bg
      position: absolute
      top: 0
      left: 0
      width: 100%
      height: 100%
      z-index: 5
      display: flex
      align-items: center
      justify-content: center
      font-size: 36px
      letter-spacing: -1px
      font-weight: bold
      line-height: 36px
      &_crashed
        color: #f54562 !important

  .knife
    border-radius: 24px
    box-shadow: 8px 8px 24px 0 rgba(9, 14, 20, 0.4), -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4)
    background-image: linear-gradient(108deg, #2d2f33 1%, #272a2e 52%, #222529)
    margin-bottom: 24px
    overflow: hidden
    display: flex

    &__left
      position: relative
      height: 100%
      margin-right: 25px
      +media(1400)
        display: none

    &__right
      padding: 24px
      width: 100%

    &__coeffs
      display: flex
      align-items: center
      justify-content: space-between
      width: 100%
      margin-bottom: 24px

      .coeff
        padding: 8px 16px
        cursor: pointer
        font-weight: bold
        font-size: 16px
        border-radius: 12px
        background-color: rgba(224, 224, 255, 0.02)

        &_active
          box-shadow: 8px 8px 24px 0 rgba(9, 14, 20, 0.4), -4px -4px 8px 0 rgba(224, 224, 255, 0.04), 0 1px 1px 0 rgba(9, 14, 20, 0.4), inset 0 -2px 1px 0 rgba(9, 14, 20, 0.8)
          background-image: linear-gradient(to bottom, #383a3d 101%, #2d2f33 1%)

    &__btn-1
      padding: 12px 36px 12px 16px
      color: $white
      box-shadow: inset 8px 8px 40px 0 rgba(9, 14, 20, 0.4), inset -4px -4px 8px 0 rgba(224, 224, 255, 0.04), inset 0 1px 1px 0 rgba(9, 14, 20, 0.4)
      background: linear-gradient(to bottom, #090e14, #222529 58%, #2d2f33)
      border: none
      font-size: 16px
      line-height: 24px
      font-weight: bold
      border-radius: 24px 12px 12px 24px
      margin-right: 4px

    &__btn-2
      padding: 12px 16px
      color: $white
      box-shadow: 0 8px 8px -4px rgba(255, 170, 0, 0.12), 0 16px 24px 0 rgba(255, 170, 0, 0.24), 0 2px 4px -1px rgba(10, 70, 82, 0.12), 0 0 1px 0 rgba(255, 170, 0, 0.24)
      background: linear-gradient(102deg, #eeff00, #ffaa00 51%, #ff5e00 100%)
      border: none
      font-size: 16px
      line-height: 24px
      font-weight: bold
      border-radius: 12px 24px 24px 12px
      margin-right: 4px
      display: flex
      align-items: center
      justify-content: space-between
      max-width: 229px
      width: 100%

    &__btns
      display: flex
      align-items: center

    &__line
      display: flex
      align-items: center
      margin-bottom: 24px

      .text
        color: $white
        letter-spacing: -1px
        font-size: 36px
        line-height: 36px
        font-weight: bold

      .emp
        font-size: 16px

      .arrow
        color: rgba(224, 224, 255, 0.4)
        margin: 0 24px

    &__bgElem-1
      box-shadow: inset 8px 8px 40px 0 rgba(9, 14, 20, 0.4), inset -4px -4px 8px 0 rgba(224, 224, 255, 0.04), inset 0 1px 1px 0 rgba(9, 14, 20, 0.4)
      background-image: linear-gradient(to bottom, #090e14 -6%, #222529 56%, #2d2f33)
      left: 0
      top: 0
      height: 100%
      width: 310px
      border-radius: 24px 1000px 0 24px

    &__bgElem-2
      border-radius: 128px 0 128px 0
      width: 264px
      height: 100%
      position: absolute
      left: 44px
      top: 0
      background-image: linear-gradient(131deg, #eeff00, #ffaa00 51%, #f54562)
</style>
