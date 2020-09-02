
export const user = {
    state: () => ({
      user: null,
    }),
    mutations: {
      setUser (state, user) {
        state.user = user
      }
    },
    actions: {
      async loadUser({ commit }) {
        try {
          const { data } = await axios.get('/user')
          commit('setUser', data)
          console.log(data)
        } catch (error) {
          console.log(error)
        }
      },
      async logout({ commit }) {
        try {
          await axios.post('logout')
          commit('setUser', null)
        } catch (error) {
          console.log(error)
        }
      }
    },
    getters: {
      getUser: state => state.user,
    },
    namespaced: true
  }
  