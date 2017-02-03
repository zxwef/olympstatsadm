import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import * as types from "../../constants/ActionTypes";
import AutocompleteInput from '../autocompleteInput';

import {fromJS} from 'immutable';
import {connect} from 'react-redux';

export default class addGameForm extends Component {

  constructor() {
    super();
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  openModal() {
    this.props.resetGame();
    $('#addGameModal').modal();
  }

  handleChange(event) {
    console.info('handleChange');
    let obj = {};
    obj[event.target.name] = event.target.value;
    this.props.setGame(fromJS(obj));
  }

  handleSubmit(event) {  // https://github.com/Lullabot/react_form/blob/master/src/contact-form.jsx
    event.preventDefault();

    //var countryName = this.refs.country.state.value;
    var countryName = this.props.game.get('country');
    var inputGameCountryWrap = document.getElementById('inputGameCountryWrap')
    var country = this.props.countries.find(elem => elem.get('name') == countryName);

    if(country) {
      var _this = this;

      (new Promise(function(resolve) {
        _this.props.addGame({
          id: _this.props.game.get('id'),
          year: _this.props.game.get('year'),
          season: _this.props.game.get('season'),
          country: country.get('id'),
          city: _this.props.game.get('city'), 
        }, resolve);
      })).then(function() {
        _this.props.receiveGames();
      });

      inputGameCountryWrap.classList.remove('has-error');
      $('#addGameModal').modal('hide');
    } else {
      inputGameCountryWrap.classList.add('has-error');
    }

  }

  render() {

    return (
      <div>

        <button type="button" className="btn btn-primary" onClick={() => this.openModal()}>
          Добавить ОИ
        </button>

        <div className="modal fade" id="addGameModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div className="modal-dialog" role="document">
            <div className="modal-content">
              <form onSubmit={this.handleSubmit}>
                <div className="modal-header">
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 className="modal-title" id="addGameModalLabel">Добавление ОИ</h4>
                </div>
                <div className="modal-body">
                    <div className="row">
                      <div className="col-md-6">
                        <div className="form-group">
                          <label htmlFor="inputGameID">Номер</label>
                          <input type="text" name="id" className="form-control" id="inputGameID" value={this.props.game.get('id')} onChange={this.handleChange} required={true} />
                        </div>
                        <div className="form-group">
                          <label htmlFor="inputGameYear">Год</label>
                          <input type="text" name="year" className="form-control" id="inputGameYear" value={this.props.game.get('year')} onChange={this.handleChange} required />
                        </div>
                        <div className="form-group">
                          <label htmlFor="" htmlFor="selectGameSeason"></label>
                          <select name="season" id="" className="form-control" value={this.props.game.get('season')} onChange={this.handleChange}>
                            <option value="summer">Летняя</option>
                            <option value="winter">Зимняя</option>
                          </select>
                        </div>
                      </div>
                      <div className="col-md-6">
                        <div className="form-group" id="inputGameCountryWrap">
                          <label htmlFor="inputGameCountry" className="control-label">Страна</label>
                          <AutocompleteInput ref="country" items={this.props.countries} entity={this.props.game} inputName="country" setState={this.props.setGame}  />
                        </div>
                        <div className="form-group">
                          <label htmlFor="inputGameCity">Город</label>
                          <input type="text" name="city" id="inputGameCity" className="form-control" value={this.props.game.get('city')} onChange={this.handleChange} required />
                        </div>
                      </div>
                    </div>
                </div>
                <div className="modal-footer">
                  <button type="button" className="btn btn-default" data-dismiss="modal">Закрыть</button>
                  <button type="submit" className="btn btn-primary">Сохранить</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    );
  }

}
