<?php
/**
 *  Abstract Base Class for Apps
 */
namespace AddressixAPI;

class App
{
  private $client;
   
  public function __construct(\AddressixAPI\Client $client)
  {
    $this->client = $client;
    $this->app_uri = $client->getBaseURI() . $this->app_base;
  }
  
  public function getBaseURI()
  {
    return $this->app_uri;
  }
  
  public function getClient()
  {
    return $this->client;
  }
}