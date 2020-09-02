"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.game = void 0;

function _objectDestructuringEmpty(obj) { if (obj == null) throw new TypeError("Cannot destructure undefined"); }

var game = {
  state: function state() {
    return {
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
    };
  },
  mutations: {
    gameChangeState: function gameChangeState(state) {
      state.isPreparatiionForGame = false;
      state.gameStart = true;
    },
    preparationStart: function preparationStart(state) {
      state.isPreparatiionForGame = true;
      state.gameStart = false;
    },
    setGameId: function setGameId(state, id) {
      state.gameId = id;
    },
    setGameHash: function setGameHash(state, hash) {
      state.gameHash = hash;
    },
    setGameStatus: function setGameStatus(state, status) {
      state.gameStatus = status;
    },
    setDuration: function setDuration(state, duration) {
      state.duration = duration;
    },
    setMultiplier: function setMultiplier(state, multiplier) {
      state.multiplier = multiplier;
    }
  },
  actions: {
    gameStart: function gameStart(_ref) {
      var commit;
      return regeneratorRuntime.async(function gameStart$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              commit = _ref.commit;
              commit('gameChangeState');
              _context.next = 4;
              return regeneratorRuntime.awrap(axios.post('/game-start'));

            case 4:
            case "end":
              return _context.stop();
          }
        }
      });
    },
    gamePrepare: function gamePrepare() {
      return regeneratorRuntime.async(function gamePrepare$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return regeneratorRuntime.awrap(axios.get('/game-prepare'));

            case 2:
            case "end":
              return _context2.stop();
          }
        }
      });
    },
    makeBet: function makeBet(_ref2) {
      return regeneratorRuntime.async(function makeBet$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _objectDestructuringEmpty(_ref2);

              _context3.next = 3;
              return regeneratorRuntime.awrap(axios.post('/make-bet'));

            case 3:
            case "end":
              return _context3.stop();
          }
        }
      });
    }
  },
  getters: {
    getTimeForNewGame: function getTimeForNewGame(state) {
      return state.secondsLeftToNewGame;
    },
    getGameStatus: function getGameStatus(state) {
      return state.gameStatus;
    },
    getDuration: function getDuration(state) {
      return state.duration;
    },
    getMultiplier: function getMultiplier(state) {
      return state.multiplier;
    }
  },
  namespaced: true
};
exports.game = game;