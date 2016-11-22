import * as types from "../constants/ActionTypes";
import {Map, List, fromJS} from 'immutable';

var initialState = {
  id: '',
  year: '',
  season: 'summer',
  country: '',
  city: ''
};

export default function(state = fromJS(initialState), action) {
  switch(action.type) {
    case types.SET_GAME:
      return setState(state, action.state);

    case types.GET_GAME:
      return state;

    case types.RESET_GAME:
      return setState(state, initialState);

    default:
      return state;
  }
}

function setState(state, newState) {
    return state.merge(newState);
}
