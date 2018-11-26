<?php
namespace AddressixAPI\App;

use AddressixAPI\App\Files\Appdata;

class Files extends \AddressixAPI\App
{
  public function __construct(\AddressixAPI\Client $client)
  {
    parent::__construct($client);
    $this->app_uri = $client->options['fs-endpoint'];
  }

  public function getAppdata()
  {
    $appdata = new Appdata($this);
    return $appdata;
  }
}
