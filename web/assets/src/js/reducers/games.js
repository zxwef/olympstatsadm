import * as types from "../constants/ActionTypes";
import {Map, List, fromJS} from 'immutable';

var initialState = {
  games: []
};

export default function(state = Map(), action) {
  switch(action.type) {
    case types.SET_GAMES:
      return setState(state, action.state);

    case types.CHECK:
      console.log('check!');
      return state;

    default:
      return state;
  }
}

function setState(state, newState) {
    return state.merge(newState);
}
