const API = 'http://api.geonames.org/';

class Geonames {

  constructor (geonamesLogin) {
    
    this.login = geonamesLogin;

  }

  getCountryList (actions) {

    this._makeRequest(actions, 'countryInfoJSON');

  }

  getStateList (actions, countryGeonameId) {

    this._makeRequest(actions, 'childrenJSON', countryGeonameId)

  }

  getCityList (actions, stateGeonameId) {

    this._makeRequest(actions, 'childrenJSON', stateGeonameId);

  }

  _makeRequest(actions, resource, geonameId) {

    let geonameIdParameter = geonameId ? 'geonameId=' + geonameId : '';
    let loginParameter = this.login ? '&username=' + this.login : '';
    let query = '?';

    (function ($) {
        $.get(API + resource + query + geonameIdParameter + loginParameter, function (response) {
            actions(response);
        });
    }(jQuery));

  }

}