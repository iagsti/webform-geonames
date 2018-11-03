(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.webformGeonamesComposite = {
      attach: function (context, settings) {

        var geonamesLogin = settings.webform_geonames.geonames_login;
        var countryField = $('.webform-geonames-composite--country', context).once('webform-geonames-composite--country');
        var stateField = $('.webform-geonames-composite--state', context).once('webform-geonames-composite--state');
        var cityField = $('.webform-geonames-composite--city', context).once('webform-geonames-composite--city');
        var neighborField = $('.webform-geonames-composite--neighbor', context).once('webform-geonames-composite--neighbor');
        
        var geonames = new Geonames(geonamesLogin);

        geonames.getCountryList(function (response) {

          let options = SelectField.generateOptions(response.geonames, 'countryName');
          SelectField.appendOptions(options, countryField);

        });

        countryField.change(function (){

          let geonameId = SelectField.getSelectedGeonameId(countryField);

          console.log(geonameId)

          geonames.getStateList(function (response) {

            console.log(response);
            let options = SelectField.generateOptions(response.geonames, 'toponymName');
            SelectField.appendOptions(options, stateField);

          }, geonameId);

        });

        stateField.change(function () {

          let geonameId = SelectField.getSelectedGeonameId(stateField);

          geonames.getCityList(function (response) {

            let options = SelectField.generateOptions(response.geonames, 'toponymName');
            SelectField.appendOptions(options, cityField)

          }, geonameId);

        });
        
      }

    }
}(jQuery, Drupal));