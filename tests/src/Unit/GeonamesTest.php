<?php

namespace Drupal\Tests\webform_geonames\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\webform_geonames\libraries\Geonames;

/**
 * Simple test to ensure that asserts pass
 * 
 * @group webform_geonames
 */
class GeonamesTest extends UnitTestCase {

  protected $container;
  protected $geonames;

  /**
   * Creating a new geonames object before run the tests.
   *
   * @return void
   */
  public function setUp() {
    parent::setUp();

    $this->geonames = new Geonames('iagUsp');
  }

  /**
   * @covers Drupal\webform_geonames\libraries\Geonames::getCountryList
   */
  public function testGetCountryList() {
    $countries = $this->geonames->getCountryList();
    $this->assertEquals(193, count($countries));
  }

  /**
   * @covers Drupal\webform_geonames\libraries\Geonames::getStateList
   */
  public function testGetStateList() {
    $states = $this->geonames->getStateList('3469034');
    $this->assertEquals(27, count($state['geonames']));
  }

  /**
   * @covers Drupal\webform_geonames\libraries\Geonames::getCityList
   */
  public function testGetCityList() {
    $cities = $this->geonames->getCityList('3665474');
    $this->assertEquals(22, count($cities['geonames']));
  }

  /**
   * @covers Drupal\webform_geonames\libraries\Geonames::makeResource
   */
  public function testMakeRresource() {
    $resource = 'http://api.geonames.org/countryInfoJSON&username=iagUsp';
    $this->assertEquals($resource, $this->geonames->makeResource('', 'countryInfoJSON'));
  }

  public function tearDown() {
    unset($this->geonames);
  }

}