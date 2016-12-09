<?php
namespace AddressixAPI\App;

class Cms extends \AddressixAPI\App
{
  protected $app_base = '/cms/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }  
}
