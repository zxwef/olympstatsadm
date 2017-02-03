import * as types from "../constants/ActionTypes";
import {Map, List, fromJS, toJS} from 'immutable';

let initialState = {
  items: [],
  total: 0,
  page: 0,
  cnt: 1
};

export default function(state = fromJS(initialState), action) {
  switch(action.type) {
    case types.SET_SPORTS:
      return setState(state, action.state);

    case types.EDIT_SPORT:
        return updateSport(state, action.key, {edit: 1});

    case types.SET_SPORT:
            return updateSport(state, action.key, action.state);

    default:
      return state;
  }
}

function setState(state, newState) {
    return state.merge(newState);
}

function updateSport(state, key, data) {
  console.log('state', state.toJS());
  return state.updateIn(['items', key], item => item.merge(data));
}
