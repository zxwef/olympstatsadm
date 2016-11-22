import * as types from "../constants/ActionTypes";
import {Map, List, fromJS} from 'immutable';

var initialState = [];

export default function(state = fromJS(initialState), action) {
  switch(action.type) {

    case types.SET_COUNTRIES:
      return setState(state, action.state);

    default:
      return state;
  }
}

function setState(state, newState) {
    return state.merge(newState);
}
