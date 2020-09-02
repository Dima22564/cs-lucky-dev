export const notifications = {
  state: () => ({
    notifications: [{
      type: 'success',
      blueText: 'jelena',
      whiteText: 'request',
      id: 'not1'
    },
      {
        type: 'message',
        blueText: 'jelena',
        whiteText: 'request',
        id: 'not2'
      },
      {
        type: 'financial',
        blueText: 'jelena',
        whiteText: 'request',
        id: 'not3'
      },
      {
        type: 'warning',
        blueText: 'jelena',
        whiteText: 'request',
        id: 'not4'
      }
    ]
  }),
  mutations: {
    deleteNotification (state, id) {
      state.notifications = state.notifications.filter(item => item.id !== id)
    }
  },
  getters: {
    getNotifications (state) {
      return state.notifications
    }
  },
  namespaced: true
}
