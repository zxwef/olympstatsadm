import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import {fromJS} from 'immutable';

import Autosuggest from 'react-autosuggest'; // http://react-autosuggest.js.org/

// https://github.com/moroshko/react-autosuggest/blob/master/demo/standalone/app.js
export default class addGameForm extends Component { // eslint-disable-line no-undef
  // https://developer.mozilla.org/en/docs/Web/JavaScript/Guide/Regular_Expressions#Using_special_characters
  escapeRegexCharacters = str => str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')

  getSuggestions = value => {
    const escapedValue = this.escapeRegexCharacters(value.trim());

    if (escapedValue === '') {
      return [];
    }

    const regex = new RegExp('^' + escapedValue, 'i');

    return this.props.items.toJS().filter(item => regex.test(item.name));
  }

  getSuggestionValue = suggestion => suggestion.name;

  renderSuggestion = suggestion => (
    <span>{suggestion.name}</span>
  )

  constructor() {
    super();
    this.state = {
      suggestions: this.getSuggestions('')
    };
  }

  componentWillReceiveProps(nextProps) {
    this.setState({
      value: nextProps.value
    });
  }

  onChange = (event, { newValue }) => {
    const state = (new Map()).set(this.props.inputName, newValue);
    this.props.setState(fromJS(state));
  };

  onSuggestionsFetchRequested = ({ value }) => {
    this.setState({
      suggestions: this.getSuggestions(value)
    });
  };

  onSuggestionsClearRequested = () => {
    this.setState({
      suggestions: []
    });
  };

  render() {
    const { suggestions } = this.state;

    const value = this.props.entity.get(this.props.inputName);

    const inputProps = {
      placeholder: 'Страна',
      value,
      onChange: this.onChange,
      className: 'form-control',
      name: this.props.inputName,
      ref: this.props.inputName
    };

    return (
      <Autosuggest // eslint-disable-line react/jsx-no-undef
        suggestions={suggestions}
        onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
        onSuggestionsClearRequested={this.onSuggestionsClearRequested}
        getSuggestionValue={this.getSuggestionValue}
        renderSuggestion={this.renderSuggestion}
        inputProps={inputProps}
      />
    );
  }
}
