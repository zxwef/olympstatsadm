import {Map, List, fromJS} from 'immutable';
import * as types from "../constants/ActionTypes";

export function receiveGames() {
  return {
    meta: {
      remote: true,
      url: 'games',
      type: types.ADD_GAME,
      state: 'games'
    },
    type: types.RECEIVE_GAMES
  };
}

export function addGame(state) {
    return {
      type: types.ADD_GAME,
      state: {
        games: state
      }
    };
}

export function receiveCities() {

}

export function check() {
  return {
    type: types.CHECK
  };
}
