
export function objectToParams(obj) {
  var result = '';
  for(var key in obj) {
    if(result != '') {
      result += '&';
    }
    result += key + '=' + obj[key];
  }
  return result;
}
