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
  }

  editGame(id) {
    this.refs.gameForm.openModal();
    this.props.receiveGame(id);
  }

  deleteGame(id) {
    if(confirm('Вы уверены в том, что хотите удалить запись #' + id)) {
      var _this = this;
      (new Promise(function(resolve){
        _this.props.deleteGame(id, resolve);
      }))
      .then(function() {
        _this.props.receiveGames();
      })
    }
  }

  getItems() {
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
            <td>
              <a href="#game" class="btn btn-sm btn-default" key={game.get('id')} >открыть</a> &nbsp;
              <button type="button" class="btn btn-sm btn-warning" onClick={() => this.editGame(game.get('id'))}>Редактировать</button> &nbsp;
              <button type="button" class="btn btn-sm btn-danger" onClick={() => this.deleteGame(game.get('id'))}>удалить</button>
            </td>
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
