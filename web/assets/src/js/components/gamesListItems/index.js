import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {connect} from 'react-redux';
import * as actions from '../../actions/GamesActions'

import AddGameForm from './add-game-form';

@connect(mapStateToProps, actions)
export default class GamesListItems extends Component {

  getItems() {
    var items = this.props.state.get('games').map(game => {
      return (
        <tr key={game.get('id')}>
          <td>{game.get('id')}</td>
          <td>{game.get('year')}</td>
          <td>{game.get('country')}</td>
          <td>{game.get('city')}</td>
          <td></td>
        </tr>
      );
    }).toArray();

    return items;
  }

  render() {
    var items = this.getItems();

    return (
      <div>
        <AddGameForm />
        <table class="table">
          <thead>
            <tr>
              <td>#</td>
              <td>Год</td>
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
  return {
    state: state.games
  };
}
