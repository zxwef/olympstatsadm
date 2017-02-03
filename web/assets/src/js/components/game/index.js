import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class Game extends Component {

  render() {
    return (
      <div>
        <div className="row">
          <div className="col-md-3">
            <div className="form-group">
              <label htmlFor="gameFilterSport"></label>
              <select name="sport" id="gameFilterSport" className="form-control"></select>
            </div>
          </div>
          <div className="col-md-3">
            <div className="form-group">
              <label htmlFor="gameFilterDiscipline"></label>
              <select name="discipline" id="gameFilterDiscipline" className="form-control"></select>
            </div>
          </div>
        </div>
        <div className="container-fluid">
          <table className="table">
            <thead>
              <tr>
                <td>#</td>
                <td>Этап</td>
                <td>Спортсмен (результат)</td>
                <td>&nbsp;</td>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    );
  }

}

/*
ogame: {
  desc: {
    year: '',
    country: '',
    ...
  }
  sports: {
    items: {
      ...
    },
    disciplines: {...}
  },
}
*/

function mapStateToProps(state) {
  return {
    //ogame: state.ogame
  };
}
