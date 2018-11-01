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
    $info = parent::getInfo() + [
      '#theme' => 'webform_geonames_composite',
         '#attached' => [
         'library' => [],
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
    ];

    $elements['state'] = [
      '#type' => 'select',
      '#title' => t('Estado'),
    ];

    $elements['city'] = [
      '#type' => 'select',
      '#title' => t('Cidade'),
    ];

    $elements['neighbor'] = [
      '#type' => 'select',
      '#title' => t('Bairro')
    ];

    return $elements;
  }

}