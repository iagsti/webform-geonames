<?php

namespace Drupal\webform_geonames\Form;

use Drupal\webform_geonames\libraries\Geonames;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;

class GeonamesForm {

  public static function getCountryList() {

    $countries = self::getGeonamesInstance()->getCountryList();
    self::saveState($countries['matchingOptions'], 'countries_geoname_id');

    return $countries['options'];

  }

  public static function getStateListAjax(array &$form, FormStateInterface $form_state) : array {

    $elementName = self::getElementName($form_state);
    $values = self::getValues($form_state);
    $state = $form['elements'][$elementName]['state'];
    $geonameId = self::getState('countries_geoname_id');

    $stateOptions = self::getGeonamesInstance()->getStateList($geonameId[$values['country']]);
    $state['#options'] += $stateOptions['options'];
    self::saveState($stateOptions['matchingOptions'], 'states_geoname_id');

    return $state;

  }

  public static function getCityListAjax (array &$form, FormStateInterface $form_state) : array {

    $elementName = self::getElementName($form_state);
    $values = self::getValues($form_state);
    $city = $form['elements'][$elementName]['city'];
    
    $geonameId = self::getState('states_geoname_id');
    $cityOptions = self::getGeonamesInstance()->getCityList($geonameId[$values['state']]);
    $city['#options'] += $cityOptions['options'];

    return $city;
    
  }


  public static function getGeonamesInstance () {

    $geonamesLogin = \Drupal::config('webform_geonames.webformgeonamessettings')
        ->get('geonames_web_service_login');

    return new Geonames($geonamesLogin);

  }

  protected static function getElementName(FormStateInterface $form_state) {
    
    $element = $form_state->getTriggeringElement();

    return explode('[', $element['#name'])[0];

  }

  protected static function getValues(FormStateInterface $form_state) {

    $triggeringElement = $form_state->getTriggeringElement()['#parents'];
    
    return $form_state->getValue($triggeringElement[0]);

  }

  protected static function saveState(array $data, $configuration) {
    $config = \Drupal::service('config.factory')->getEditable('webform_geonames.settings');
    $configurationItem = 'webform_geonames.' . $configuration;
    $config->set($configurationItem, $data);
    $config->save();
  }

  protected static function getState($key) {
    $config = \Drupal::config('webform_geonames.settings');
    $configuration = 'webform_geonames.' . $key;

    return $config->get($configuration);

  }

}