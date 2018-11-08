<?php 

namespace Drupal\webform_geonames\libraries;

use GuzzleHttp\Exception\RequestException;

const API = 'http://api.geonames.org/';

class Geonames {
  
  private $geonamesLogin;
  private $api;

  public function __construct($geonamesLogin)
  {
    $this->geonamesLogin = $geonamesLogin;
    $this->api = API;
  }

  public function getCountryList() {

    $resource = $this->makeResource(null, 'countryInfoJSON');
    $response =  $this->makeRequest($resource);
    $options = $this->generateOptions('countryName', 'countryName', $response->geonames);

    $matchingOtions = $this->generateOptions('countryCode', 'geonameId', $response->geonames);

    return ['options' => $options, 'matchingOptions' => $matchingOtions];

  }

  public function getStateList($countryGeonameId) {

    if (!isset($countryGeonameId)) {

      $countryGeonameId = '3469034';

    }

    $resource = $this->makeResource($countryGeonameId, 'childrenJSON');
    $response = $this->makeRequest($resource);

    $options = $this->generateOptions('toponymName', 'toponymName', $response->geonames);
    $matchingOtions = $this->generateOptions('toponymName', 'geonameId', $response->geonames);

    return ['options' => $options, 'matchingOptions' => $matchingOtions];

  }

  public function getCityList($stateGeonameId) {

    $resource = $this->makeResource($stateGeonameId, 'childrenJSON');
    $response = $this->makeRequest($resource);
    $options = $this->generateOptions('toponymName', $response->geonames);

    return $options;

  }

  public function makeRequest ($resource) {
    
    $client = \Drupal::httpClient();
    $response = [];

    try {
      $request = $client->get($resource);
      $response = $request->getBody();
    } catch (RequestException $e) {
      drupal_set_message($e);
    }

    return json_decode($response);
  }

  public function makeResource ($geonameId, $resource) {
    
    $geonameIdParameter = $geonameId ? 'geonameId=' . $geonameId : '';
    $loginParameter = $this->geonamesLogin ? '&username=' . $this->geonamesLogin : '';
    $query = '?';

    $request = $this->api . $resource . $query . $geonameIdParameter . $loginParameter;

    return $request;

  }

  protected function generateOptions($key, $value, array $data) {

    $keys = array_map(function($item) use ($key) {
      return $item->{$key};
    }, $data);

    $values = array_map(function($item) use ($value) {
      return $item->{$value};
    }, $data);

    return array_combine($keys, $values);

  }

  protected function getGeonameId($geonames) {

    return $geonames->geonames[0]->geonameId;

  }

}