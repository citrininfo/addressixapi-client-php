<?php
namespace AddressixAPI\App;

use AddressixAPI\App;
use AddressixAPI\Client;

class Email extends App
{
  protected $app_base = '/email/v1';
  
  public function __construct(Client $client)
  {
    parent::__construct($client);    
  }  
}
