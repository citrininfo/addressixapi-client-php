<?php
namespace AddressixAPI\App;

class Files extends \AddressixAPI\App
{
  protected $app_base = '/aixfs/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }
}
