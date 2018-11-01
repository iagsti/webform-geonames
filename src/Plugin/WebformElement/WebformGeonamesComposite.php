<?php

namespace Drupal\webform_geonames\Plugin\WebformElement;

use Drupal\webform\WebformSubmissionInterface;
use Drupal\webform\Plugin\WebformElement\WebformCompositeBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides an 'geonames' element.
 *
 * @WebformElement(
 *   id = "webform_geonames_composite",
 *   label = @Translation("Geonames Address Composite"),
 *   description = @Translation("Geonames API provides a form element to collect
 * address information (street, city, state, zip)."),
 *   category = @Translation("Composite elements"),
 *   multiline = TRUE,
 *   composite = TRUE,
 *   states_wrapper = TRUE,
 * )
 */
class WebformGeonamesComposite extends WebformCompositeBase {

  /**
   * {@inheritDoc}
   */
  protected function formatHtmlItemValue(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    return $this->formatTextItemValue($element, $webform_submission, $options);
  }

  /**
   * {@inheritDoc}
   */
  protected function formatTextItemValue(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    $value = $this->getValue($element, $webform_submission, $options);

    return [];
  }

}