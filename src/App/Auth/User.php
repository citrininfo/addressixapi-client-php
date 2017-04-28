<?php
namespace AddressixAPI\App\Auth;

use AddressixAPI\App\Resource

class User extends Resource
{
  protected $resource_uri = '/users';

  public $contractid;
  public $applicationid = 0;
  public $name;

  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get_accesstoken'] = 
      array(
        'method' => 'GET',
        'uri' => '/users/:id/accesstoken'
      );
  }

  function set($data)
  {
    $this->id = $data->userid;
    $this->contractid = $data->contractid;
    if (isset($data->applicationid))
      $this->applicationid = $data->applicationid;
    $this->name = $data->name;
  }
  
  public function getMe()
  {
    $this->request('get',array('id'=>'me'));
    $this->set($this->data);
    return $this->data;
  }
  
  public function getAccessToken($userid)
  {
    $this->request('get_accesstoken',array('id'=>$userid));
    return $this->data;
  }
}