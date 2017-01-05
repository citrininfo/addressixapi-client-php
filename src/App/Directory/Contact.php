<?php
namespace AddressixAPI\App\Directory;

class Contact extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/contacts';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/contacts/:id'
	);
    $this->functions['search'] = 
      array(
	'method' => 'GET',
        'uri' => '/contacts/'
	);
  }
  
  public function get($id)
  {
    $this->request('get', array('id'=>$id));
    return $this->data;
  }

  public function search($filters)
  {
    $this->request('search', $filters);
    return $this->data;
  }
}