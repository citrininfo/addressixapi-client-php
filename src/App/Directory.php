<?php
namespace AddressixAPI\App;

class Directory extends \AddressixAPI\App
{
  protected $app_base = '/directory/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }  
}
