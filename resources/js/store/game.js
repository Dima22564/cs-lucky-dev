export const game = {
    state: () => ({
      gameHash: 'sdfghjklkjhgfghjkdfdg',
      isPreparatiionForGame: true,
      gameStart: false,
      gameStatus: 0,
      gameId: null,
      history: [],
      bets: [],
      secondsLeftToNewGame: 10,
      duration: 0,
      multiplier: 0
    }),
    mutations: {
      gameChangeState(state) {
            state.isPreparatiionForGame = false
            state.gameStart = true
        },
        preparationStart(state) {
            state.isPreparatiionForGame = true
            state.gameStart = false
        },
      setGameId(state, id) {
        state.gameId = id
      },
      setGameHash(state, hash) {
        state.gameHash = hash
      },
      setGameStatus(state, status) {
        state.gameStatus = status
      },
      setDuration(state, duration) {
        state.duration = duration
      },
      setMultiplier(state, multiplier) {
        state.multiplier = multiplier
      },
    },
    actions: {
      async gameStart({ commit }) {
        commit('gameChangeState')
        await axios.post('/game-start')
      },
      async gamePrepare() {
        await axios.get('/game-prepare')
      },
      async makeBet({}) {
        await axios.post('/make-bet')
      }
    },
    getters: {
      getTimeForNewGame: (state) => state.secondsLeftToNewGame,
      getGameStatus: (state) => state.gameStatus,
      getDuration: (state) => state.duration,
      getMultiplier: (state) => state.multiplier
    },
    namespaced: true
}
  