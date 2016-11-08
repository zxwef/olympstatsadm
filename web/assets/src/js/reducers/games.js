import * as types from "../constants/ActionTypes";
//import * as GamesActions from "../actions/GamesActions";
import {Map, List, fromJS} from 'immutable';

export default function games(state = Map(), action) {

  switch(action.type) {
    case types.ADD_GAME:
      /*return {
        games: {
          ...state.games
        }
      }*/
      //console.info('case ADD_GAME');
      return addGame(state, action.state);

    case types.RECEIVE_CITIES:
      return state.merge(action.cities);

    case types.CHECK:
      console.log('check!!!');
      return state;

    default:
      return state;
  }
}

function addGame(state, newState) {
    return state.merge(newState);
}
