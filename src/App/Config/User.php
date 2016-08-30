<?php
namespace AddressixAPI\App\Config;

class User extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/users';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get_accesstoken'] = 
      array(
        'method' => 'GET',
        'uri' => '/users/:id/accesstoken'
      );
  }
  
  public function getMe()
  {
    $this->request('get',array('id'=>'me'));
    return $this->data;
  }
  
  public function getAccessToken($userid)
  {
    $this->request('get_accesstoken',array('id'=>$userid));
    return $this->data;
  }
}