import React, {Component, PropTypes} from "react";
import ReactDOM from "react-dom";

import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';

import * as GamesActions from "../actions/GamesActions";
import GamesListItems from "../components/gameListItem";

//import styles from "../../GamesListApp";

@connect(mapStateToProps)
export default class GamesListApp extends Component {
    doSomething() {
      console.info('do something.');
    }
    render() {
      return (
        <div>
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
            <GamesListItems state={this.props.state} />
          </table>
          <input type="text" class="form-control"  />
          <button class="btn btn-default" onClick={this.doSomething}>Сделать что-то</button>
        </div>
      )
    }
}

function mapStateToProps(state) {
  return {
    state: state.games
  };
}





/*
@connect(state => ({
  games: state.games
}))
export default class GamesListApp extends Component {
  doSomething() {
    console.info('do something');
  }
  render() {
    console.log(games);
    const {games: {games}, dispatch} = this.props;

    return (
      <div>
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
          <GamesListItems games={games} />
        </table>
        <input type="text" class="form-control"  />
        <button class="btn btn-default" onClick={this.doSomething}>Сделать что-то</button>
      </div>
    )
  }
}
*/
