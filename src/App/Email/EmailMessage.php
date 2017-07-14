<?php
namespace AddressixAPI\App\Email;

use AddressixAPI\App\Resource;

class EmailMessage extends Resource
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
    $this->functions['get_raw'] = 
      array(
        'method' => 'GET',
        'uri' => '/boxes/:boxid/emails/:emailid/raw'
      );
    $this->functions['list'] = 
      array(
        'method' => 'GET',
        'uri' => '/boxes/:boxid/emails'
      );
  }

  public function get($boxid, $emailid, $params = array())
  {    
    $params['boxid'] = $boxid;
    $params['emailid'] = $emailid;
    $this->request('get', $params);
    return $this->data;
  }
  
  public function getRaw($boxid, $emailid, $params = array())
  {    
    $params['boxid'] = $boxid;
    $params['emailid'] = $emailid;
    $this->request('get_raw', $params);
    return $this->data;
  }

  public function getList($boxid, array $params=array())
  {
    $params['boxid'] = $boxid;
    $this->request('list', $params);
    return $this->data;
  }

}