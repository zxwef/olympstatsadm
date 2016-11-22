import * as types from "../constants/ActionTypes";
import {List, Map, fromJS} from 'immutable';

export default function(state = Map(), action) {

  switch(action.type) {
    case types.SET_STATE:
      return setState(state, action.state);

    default:
      return state;
  }
}

function setState(state, newState) {
    return state.merge(newState);
}
