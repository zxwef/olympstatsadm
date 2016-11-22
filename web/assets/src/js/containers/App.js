import React from "react";
import ReactDOM from "react-dom";
import { combineReducers, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';
import { Router, Route, hashHistory } from 'react-router';
import { createStore as initialCreateStore, compose } from 'redux';
import {fromJS} from 'immutable';

var $ = require('jquery');
global.$ = global.jQuery = $;
require('bootstrap');

import 'bootstrap/dist/css/bootstrap.css';

let createStore = initialCreateStore;

import * as types from "../constants/ActionTypes";
import * as actions from '../actions/GamesActions'
import * as reducers from "../reducers";

import Login from '../components/login';
import GamesListItems from '../components/gamesListItems';


// http://redux.js.org/docs/api/applyMiddleware.html
import remoteActionMiddleware from '../remote-action-middleware';
const reducer = combineReducers(reducers);
const createStoreWithMiddleware = applyMiddleware(remoteActionMiddleware)(createStore);
const store = createStoreWithMiddleware(reducer);

//------------------------------------------------------------------------------

export default class App extends React.Component {

  constructor() {
    super();

    store.dispatch(actions.setState({}));
    store.dispatch(actions.receiveGames());
    store.dispatch(actions.receiveCountries());
  }

  render() {
    return (
      <div class="container">
        <div class="container-fluid">
          <Provider store={store}>
            <Router history={hashHistory}>
              <Route path="/" component={Login} />
              <Route path="/games" component={GamesListItems} />
            </Router>
          </Provider>
        </div>
      </div>
    );
  }

}
