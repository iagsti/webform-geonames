class SelectField {

  static generateOptions(data, key) {

    let options = [];

    data.forEach(function (item) {
          
      let text = item[key];
      let option = new Option(text, text);

      option.setAttribute('geonameid', item.geonameId);
      options.push(option);
    
    });
    
    return options;

  }

  static appendOptions (options, select) {

    (function ($) {
        select.find('option').remove();
        select.append($(options));
    } (jQuery));

  }

  static getSelectedGeonameId (select) {
    let geonameId = '';

    (function ($) {
      
      geonameId = select.find(':selected').attr('geonameid');

    } (jQuery));

    return geonameId;

  }

}