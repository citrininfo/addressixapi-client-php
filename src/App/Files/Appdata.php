<?php
namespace AddressixAPI\App\Files;

class Appdata extends Folder
{
  protected $resource_uri = '/';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/appdata'
      );
  }
  
  function get() {
    $this->request('get');
    $this->set($this->data);
  }

  function getByPath($path) {
    if (!$this->id) {
      $this->get();
    }
    return parent::getByPath($path);
  }
}