import {fromJS} from 'immutable';

export default store => next => action => {
  console.log('in middleware: ', action);
  //return next(action);

  if(action.meta && action.meta.remote) {
    fetch('/api/1.0/' + action.meta.url, {credentials: 'same-origin'})
        .then(function(response) {
          return response.json();
        })
        .then(function(result) {
          //store.dispatch(result);
          var obj = {};

          obj['type'] = action.meta.type;
          obj['state'] = {};
          obj['state'][action.meta.state] = (result);
          store.dispatch(obj);

          /*store.dispatch({
            type: action.meta.type,
            state: {
              action.meta.entity: result
            }
          });*/
        })
        .catch(function(err) {
          console.error('error: ' + err);
        });
  } else {
    return next(action);
  }
}
