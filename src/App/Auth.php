<?php
namespace AddressixAPI\App;

class Auth extends \AddressixAPI\App
{
  protected $app_base = '/auth/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }
}
