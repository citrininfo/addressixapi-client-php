<?php
namespace AddressixAPI\App\Files;

class Home extends Folder
{
  protected $resource_uri = '/';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get_my_home'] = 
      array(
        'method' => 'GET',
        'uri' => '/home'
      );
    $this->functions['get_homes'] = 
      array(
        'method' => 'GET',
        'uri' => '/homes/'
      );
    $this->functions['get_home'] = 
      array(
        'method' => 'GET',
        'uri' => '/homes/:id'
      );
    
  }
  
  function getMyHome() {
    $this->request('get_my_home');
    $this->id = $this->data->id;
    return $this->data;
  }

  function getHomes() {
    $this->request('get_my_home');
    return $this->data;
  }

  function getHome($id) {
    $this->request('get', array('id'=>$id));
    $this->id = $this->data->id;
    return $this->data;
  }
}