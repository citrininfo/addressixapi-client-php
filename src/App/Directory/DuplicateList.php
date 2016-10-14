<?php
namespace AddressixAPI\App\Directory;

class DuplicateList extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/duplicates';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/duplicates/lists/:id'
      );
    $this->functions['get_lists'] = 
      array(
        'method' => 'GET',
        'uri' => '/duplicates/lists'
      );
    $this->functions['add_list'] = 
      array(
        'method' => 'POST',
        'uri' => '/duplicates/lists'
      );
  }
  
  public function getLists()
  {
    $this->request('get_lists');
    return $this->data;
  }
  
  public function addList($params)
  {
    $this->request('add_list', $params);
    return $this->data;
  }
  
  public function getList($id)
  {
    $this->request('get', array('id'=>$id));
    return $this->data;
  }
}