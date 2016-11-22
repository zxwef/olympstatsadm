import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {connect} from 'react-redux';
import * as actions from '../../actions/GamesActions';
import {fromJS, toJS} from 'immutable';

import AddGameForm from './add-game-form';

@connect(mapStateToProps, actions)
export default class GamesListItems extends Component {

  constructor() {
    super();
    //store.dispatch(actions.receiveCountries);
  }

  editGame(id) {
    //$('#addGameModal').modal();
    this.refs.gameForm.openModal();
    this.props.receiveGame(id);
  }

  getItems() {
    //console.info('getItems', this.props.state.get('items'));
    var items =
      this.props.games.get('items') ?
      this.props.games.get('items').map(game => {
        var season = game.get('season') == 'summer' ? 'летняя' : 'зимняя';
        return (
          <tr key={game.get('id')}>
            <td>{game.get('id')}</td>
            <td>{game.get('year')}</td>
            <td>{season}</td>
            <td>{game.get('country')}</td>
            <td>{game.get('city')}</td>
            <td><button type="button" class="btn btn-sm btn-default" onClick={() => this.editGame(game.get('id'))}>Редактировать</button></td>
          </tr>
        );
      }).toArray()
      : null;

    return items;
  }

  render() {
    var items = this.getItems();
    //game={this.props.game} countries={this.props.countries}
    return (
      <div>
        <AddGameForm ref="gameForm" {...this.props} />
        <table class="table">
          <thead>
            <tr>
              <td>#</td>
              <td>Год</td>
              <td>Сезон</td>
              <td>Страна</td>
              <td>Город</td>
              <td>&nbsp;</td>
            </tr>
          </thead>
          <tbody>
            {items}
          </tbody>
        </table>
        <button class="btn btn-default" onClick={this.props.check}>check!!!</button>
      </div>
    );
  }
};

function mapStateToProps(state) {

  /*
  mapStateToProps
  https://github.com/teropa/redux-voting-client/blob/master/src/components/Voting.jsx
  */

  return {
    games: state.games,
    game: state.game,
    countries: state.countries
  };
}
