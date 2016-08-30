<?php
namespace AddressixAPI\App;

class Config extends \AddressixAPI\App
{
  protected $app_base = '/settings/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }  
}
