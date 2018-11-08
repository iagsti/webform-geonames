<?php

namespace Drupal\webform_geonames\Form;

use Drupal\webform_geonames\libraries\Geonames;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;

class GeonamesForm {

  public static function getCountryList() {

    $countries = self::getGeonamesInstance()->getCountryList();
    self::saveState($countries['matchingOptions']);

    return $countries['options'];

  }

  public static function getStateListAjax(array &$form, FormStateInterface $form_state) : AjaxResponse {

    $elementName = self::getElementName($form_state);
    $values = self::getValues($form_state);
    $state = $form['elements'][$elementName]['state'];
    $stateId = '#' . $state['#wrapper_attributes']['id'];

    $stateOptions = self::getGeonamesInstance()->getStateListByCountryName($values['country']);

    $state['#options'] += $stateOptions;

    $renderer = \Drupal::service('renderer');
    $response = new AjaxResponse();
    $response->addCommand(new ReplaceCommand($stateId, $renderer->render($state)));
    return $response;

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

  protected static function saveState(array $data) {
    
    \Drupal::state()->setMultiple($data);

  }

  protected static function getState($key) {

    return \Drupal::state()->get($key);

  }

}