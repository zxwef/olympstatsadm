import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {connect} from 'react-redux';

import * as actions from '../../actions/GamesActions';

@connect(mapStateToProps, actions)
export default class Sports extends Component {

  constructor() {
    super();
    this.editSport = this.editSport.bind(this);
    this.saveSport = this.saveSport.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onChangeTitle = this.onChangeTitle.bind(this);

    this.state = {
      title: ''
    };
  }

  componentDidMount() {
    this.props.receiveSports();
  }

  editSport(key) {
    //console.log('editSport', this);
    this.props.editSport(key);
  }

  saveSport(event, key) {
    let self = this;
    console.log(key);
    let item = {};
    if(typeof key != 'undefined') {
      item = this.props.items.get(key).toJS();
      console.log('item', item);
    } else {
      item = {
        id: 0,
        title: this.state.title
      };
    }

    (new Promise(function(resolve, reject) {
      self.props.saveSport(item, resolve);
    })).then(function() {
      self.props.receiveSports();
    });

  }

  onChange(event, key) {
    var obj = {};
    obj[event.target.name] = event.target.value;
    this.props.setSport(key, obj);
  }

  onChangeTitle(event) {
    this.setState({title: event.target.value});
  }

  getItems() {
    console.log('getItems', this.props.items);
    var items = this.props.items.map((item, key) => {
      let result =
      item.get('edit') ?
      (
        <tr key={item.get('id')}>
          <td>{item.get('id')}</td>
          <td><input type="text" name="title" value={item.get('title')} onChange={(event) => this.onChange(event, key)} /></td>
          <td>
            <button type="button" class="btn btn-sm btn-warning" onClick={(event) => this.saveSport(event, key)}>сохранить</button>
          </td>
        </tr>
      )
      :
      (
        <tr key={item.get('id')}>
          <td>{item.get('id')}</td>
          <td>{item.get('title')}</td>
          <td>
            <button type="button" class="btn btn-sm btn-warning" onClick={() => this.editSport(key)}>редактировать</button>
          </td>
        </tr>
      );
      return result;
    }).toArray();

    return items;
  }

  loadPage(p) {
    this.props.receiveSports(p);
  }

  getNav() {
    let pages = this.props.total / this.props.cnt;
    let nav = [];

    for(let i = 0; i < pages; i++) {
      let i1 = i + 1;
      nav.push((<a href="javascript:;" key={i} onClick={() => this.loadPage(i)}>{i1}</a>));
    }

    return nav;
  }

  render() {
    let items = this.getItems();
    let nav = this.getNav();

    return(
      <div>
        <table className="table">
          <thead>
            <tr>
              <td>#</td>
              <td>название</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input type="text" name="title" value={this.state.title} onChange={this.onChangeTitle}/></td>
              <td>
                <button type="button" class="btn btn-sm btn-warning" onClick={this.saveSport}>добавить</button>
              </td>
            </tr>
            {items}
          </tbody>
        </table>
        {nav}
      </div>
    );
  }

}

function mapStateToProps(state) {
  //console.info('sports component: ', state.sports);
  return {
    items: state.sports.get('items'),
    total: state.sports.get('total'),
    page: state.sports.get('page'),
    cnt: state.sports.get('cnt')
  };
}
