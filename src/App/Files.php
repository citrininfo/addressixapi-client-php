<?php
namespace AddressixAPI\App;

use AddressixAPI\App\Files\Appdata;

class Files extends \AddressixAPI\App
{
  protected $app_base = '/aixfs/v1';
  
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);    
  }

  public function getAppdata()
  {
    $appdata = new Appdata($this);
    return $appdata;
  }
}
