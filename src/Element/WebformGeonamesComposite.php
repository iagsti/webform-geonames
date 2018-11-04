<?php

namespace Drupal\webform_geonames\Element;

use Drupal\webform\Element\WebformCompositeBase;


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
      '#attached' => [
         'library' => [
            'webform_geonames/webform_geonames_composite'
          ],
          'drupalSettings' => [
            'webform_geonames' => ['geonames_login' => $geonamesLogin]
          ]
        ]
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

    $elements['country'] = [
      '#type' => 'select',
      '#title' => t('País'),
      '#attributes' => ['class' => ['webform-geonames-composite--country']]
    ];

    $elements['state'] = [
      '#type' => 'select',
      '#title' => t('Estado'),
      '#attributes' => ['class' => ['webform-geonames-composite--state']]
    ];

    $elements['city'] = [
      '#type' => 'select',
      '#title' => t('Cidade'),
      '#attributes' => ['class' => ['webform-geonames-composite--city']]
    ];

    return $elements;
  }

}