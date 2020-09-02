
export const common = {
  state: () => ({
    windowSize: 0,
    currentTab: 'game'
  }),
  mutations: {
    setWindowSize (state, windowsize) {
      state.windowSize = windowsize
    },
    changeTab (state, tab) {
      state.currentTab = tab
    }
  },
  getters: {
    getWindowSize: state => state.windowSize,
    getCurrentTab: state => state.currentTab
  },
  namespaced: true
}
