import {Map, List, fromJS} from 'immutable';
import * as types from "../constants/ActionTypes";
import {objectToParams} from '../utils/misc';

/*

https://github.com/tshelburne/redux-batched-actions
https://github.com/acdlite/redux-promise

*/

export function setState(state) {
    return {
      type: types.SET_STATE,
      state: state
    };
}

export function setGames(state) {
    return {
      type: types.SET_GAMES,
      state: state
    };
}

export function receiveGames() {
  return {
    meta: {
      remote: true,
      url: 'games',
      type: types.SET_GAMES,
    },
    type: types.RECEIVE_GAMES
  };
}

//------------------------------------------------

export function setGame(state) {
    return {
      type: types.SET_GAME,
      state: state
    };
}

export function receiveGame(id) {
  return {
    meta: {
      remote: true,
      url: 'games/' + id,
      type: 'SET_GAME'
    },
    type: types.RECEIVE_GAME
  }
}

export function addGame(state, resolve) {
  return {
    meta: {
      /*type: types.UPDATE_GAMES,*/
      resolve: resolve,
      remote: true,
      url: 'games',
      options: {
        method: 'post',
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify(state), /*objectToParams(state)*/
      },

    },
    type: types.ADD_GAME,
  }
}

export function deleteGame(id, resolve) {
  return {
    type: types.DELETE_GAME,
    meta: {
      remote: true,
      url: 'games/' + id,
      options: {
        method: 'delete',
        headers: {
          'Content-type': 'application/json'
        }
      },
      resolve: resolve
    },
  };
}

//------------------------------------------------------------------------------

export function receiveCountries() {
  return {
    meta: {
      remote: true,
      url: 'countries',
      type: types.SET_COUNTRIES
    },
    type: types.RECEIVE_COUNTRIES
  }
}

export function resetGame() {
  return {
    type: types.RESET_GAME
  };
}

//------------------------------------------------------------------------------

export function receiveSports(p = 0) {
  return {
    meta: {
      remote: true,
      url: 'sports/?p=' + p,
      type: types.SET_SPORTS
    },
    type: types.RECEIVE
  }
}

export function receiveGames11111111111() {
  return {
    meta: {
      remote: true,
      url: 'games',
      type: types.SET_GAMES,
    },
    type: types.RECEIVE_GAMES
  };
}

export function editSport(id) {
  return {
    type: types.EDIT_SPORT,
    key: id
  }
}

export function setSport(key, state) {
  return {
    type: types.SET_SPORT,
    key: key,
    state: state
  }
}

export function saveSport(item, resolve) {
  return {
    meta: {
      resolve: resolve,
      remote: true,
      url: 'sports/',
      options: {
        method: 'post',
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify(item),
      },

    },
    type: types.SAVE,
  }
}
