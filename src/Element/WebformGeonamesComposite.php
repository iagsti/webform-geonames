<?php

namespace Drupal\webform_geonames\Element;

use Drupal\Component\Utility\Html;
use Drupal\webform\Element\WebformCompositeBase;
use Drupal\webform_geonames\Form\GeonamesForm;


/**
 * Provides a Webform element for geonames composite
 * 
 * @FormElement("webform_geonames_composite")
 */
class WebformGeonamesComposite extends WebformCompositeBase {

  
  /**
   * {@inheritDoc}
   */
  public function getInfo() {

    $geonamesLogin = \Drupal::config('webform_geonames.webformgeonamessettings')->get('geonames_web_service_login');

    $info = parent::getInfo() + [
      '#theme' => 'webform_geonames_composite',
    ];

    return $info;
  }

  /**
   * {@inheritDoc}
  */
  public static function preRenderCompositeFormElement($element)
  {
    $element = parent::preRenderCompositeFormElement($element);

    return $element;
  }

  public static function getCompositeElements(array $elements)
  {
    $elements = [];
    $htmlId = Html::getUniqueId('webform-geonames');

    $elements['country'] = [
      '#type' => 'select',
      '#title' => t('País'),
      '#options' => GeonamesForm::getCountryList(),
      '#ajax' => [
        'callback' => 'Drupal\webform_geonames\Form\GeonamesForm::getStateListAjax',
        'event' => 'change',
        'wrapper' => 'webform-geonames-edit-state',
        'progress' => [
          'type' => 'throbber',
          'message' => t('Carregando...'),
        ],
      ],
    ];

    $elements['state'] = [
      '#type' => 'select',
      '#title' => t('Estado'),
      '#validated' => TRUE,
      '#ajax' => [
        'callback' => 'Drupal\webform_geonames\Form\GeonamesForm::getCityListAjax',
        'event' => 'change',
        'wrapper' => 'webform-geonames-edit-city',
        'progress' => [
          'type' => 'throbber',
          'mssage' => t('Carregando...')
        ]
      ],
      '#wrapper_attributes' => ['id' => 'webform-geonames-edit-state']
    ];

    $elements['city'] = [
      '#type' => 'select',
      '#title' => t('Cidade'),
      '#attributes' => ['id' => ['webform-geonames-edit-city']]
    ];

    return $elements;
  }

}