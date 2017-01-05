<?php
namespace AddressixAPI\App\Directory;

class Group extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/groups';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/groups/:id'
	);
    $this->functions['patch'] = 
      array(
        'method' => 'PATCH',
        'uri' => '/groups/:id'
	);
  }
  
  public function get($id)
  {
    $this->request('get', array('id'=>$id));
    return $this->data;
  }

  public function patch($id, array $params)
  {
    $params['id'] = $id;
    $this->request('patch', $params);
    return $this->data;
  }
}