<?php

namespace Drupal\webform_geonames\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebformGeonamesSettingsForm.
 */
class WebformGeonamesSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webform_geonames.webformgeonamessettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webform_geonames_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webform_geonames.webformgeonamessettings');
    $form['geonames_web_service_login'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Geonames web service login'),
      '#description' => $this->t('Geonames web service account login'),
      '#maxlength' => 100,
      '#size' => 100,
      '#default_value' => $config->get('geonames_web_service_login'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('webform_geonames.webformgeonamessettings')
      ->set('geonames_web_service_login', $form_state->getValue('geonames_web_service_login'))
      ->save();
  }

}
