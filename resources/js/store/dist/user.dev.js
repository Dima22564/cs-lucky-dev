"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.user = void 0;
var user = {
  state: function state() {
    return {
      user: {
        id: 3,
        name: 'sfdf'
      }
    };
  },
  mutations: {},
  getters: {
    getUser: function getUser(state) {
      return state.user;
    }
  },
  namespaced: true
};
exports.user = user;