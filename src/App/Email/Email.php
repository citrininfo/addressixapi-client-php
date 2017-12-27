<?php
namespace AddressixAPI\App\Email;

use AddressixAPI\App\Resource;

class Email extends Resource
{
  protected $resource_uri = '/email';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/boxes/:boxid/emails/:emailid'
      );
    $this->functions['list'] = 
      array(
        'method' => 'GET',
        'uri' => '/boxes/:boxid/emails'
      );    
  }

  public function getList($boxid, array $params=array())
  {
    $params['boxid'] = $boxid;
    $this->request('list', $params);
    return $this->data;
  }  
}