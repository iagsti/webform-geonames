const API = 'http://api.geonames.org/';

class Geonames {

  constructor (geonamesLogin) {
    
    this.geonamesLogin = geonamesLogin;

  }

  getCountryList (actions) {

    this._makeRequest(actions, 'countryInfoJSON');

  }

  getSatateList (actions, countryGeonameId) {

    this._makeRequest(actions, 'childrenJSON', countryGeonameId)

  }

  getCityList (actions, stateGeonameId) {

    this._makeRequest(actions, 'childrenJSON', stateGeonameId);

  }

  getNeighborList (actions, cityGeonameId) {

    this._makeRequest(actions, 'childrenJSON', cityGeonameId);

  }

  _makeRequest(actions, resource, geonameId) {

    let geonameIdParameter = geonameId ? 'geonameId=' + geonameId : '';
    let loginParameter = this.geonamesLogin ? '&username=' + this.geonamesLogin : '';
    let query = '?';

    (function ($) {
        $.get(API + resource + query + geonameIdParameter + loginParameter, function (response) {
            actions(response);
        });
    });

  }

}