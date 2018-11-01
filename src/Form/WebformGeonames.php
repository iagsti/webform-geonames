<?php

namespace Drupal\webform_geonames\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebformGeonames.
 */
class WebformGeonames extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webform_geonames';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['geonames_web_service_login'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Geonames Web Service Login'),
      '#description' => $this->t('Enter the Geonames Web service account login'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
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
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
