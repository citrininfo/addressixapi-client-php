<?php
namespace AddressixAPI\App\Email;

use AddressixAPI\App\Resource;

use AddressixAPI\App\Files;
use AddressixAPI\App\Files\File;

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
    $this->functions['create_upload'] =
      array(
            'method' => 'POST',
            'uri' => '/boxes/:boxid/emails/:emailid/raw'
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

  public function store($boxid, $emailid, $content, array $params=array())
  {
    // create the upload link
    $params['boxid'] = $boxid;
    $params['emailid'] = $emailid;    
    $this->request('create_upload', $params);

    $sessionid = $this->data->sessionid;
    $headers = array();
    if (isset($params['mime'])) {
      $headers['Content-Type'] = $params['mime'];
    }

    $filesapp = new Files($this->app->getClient());
    $file = new File($filesapp);
    $file->request('upload', array('sessionid'=>$sessionid, 'data' => $content), $headers, 3);
    return $file->getId();
  }  
}