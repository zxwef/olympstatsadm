import {fromJS} from 'immutable';

export default store => next => action => {
  console.log('in middleware: ', action);

  if(action.meta && action.meta.remote) {
    var options = {
      credentials: 'same-origin',
      ...action.meta.options
    };

    fetch('/api/1.0/' + action.meta.url, options)
        .then(function(response) {
          return response.json();
        })
        .then(function(result) {
          var obj = {};

          if(result.response) {
            obj['state'] = result.response;
          }

          if(action.meta.type) { // добавить нотификации (успешно ли сохранилось)
            obj['type'] = action.meta.type;
            store.dispatch(obj);
          } else if(action.meta.resolve) {
            action.meta.resolve();
          }
        })
        /*.catch(function(err) {
          console.error('error: ' + err);
        })*/;
  } else {
    return next(action);
  }
}
