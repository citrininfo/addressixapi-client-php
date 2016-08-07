<?php
namespace AddressixAPI\App;

class Contact extends \AddressixAPI\App
{
  protected $app_base = '/contact/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }
  
  public function getMe()
  {
    if (!isset($this->me)) {
      $this->me = new \AddressixAPI\App\Contact\Contact($this->client);
    } 
  }
}
