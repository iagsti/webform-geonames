<?php

namespace Drupal\Tests\webform_geonames\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\JavascriptTestBase;

/**
 * JavaScript tests.
 *
 * @ingroup webform_geonames
 *
 * @group webform_geonames
 */
class GeonamesJsTest extends JavaScriptTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['webform_geonames'];

  /**
   * A user with permission to administer site configuration.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->user = $this->drupalCreateUser(['administer site configuration']);
    $this->drupalLogin($this->user);
  }

  /**
   * Tests that the home page loads with a 200 response.
   */
  public function testFrontpage() {
    $this->drupalGet(Url::fromRoute('<front>'));
    $page = $this->getSession()->getPage();
    $this->assertSession()->statusCodeEquals(200);
  }

}
