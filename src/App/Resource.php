<?php
namespace AddressixAPI\App;

class Resource
{
  protected $app;
  protected $id;
  protected $data;
  protected $resource_uri = '/resource';
  
  public function __construct($app)
  {
    $this->app = $app;
    $this->functions = 
      array(
        'get' => 
          array(
            'method' => 'GET',
            'uri' => $this->resource_uri . '/:id'
            )
      );
  }
  
  // get the resource
  public function request($name, array $params = array())
  {
    if (!isset($this->functions[$name])) {
      throw new \AddressixAPI\Exception('Function '.$name.' is not defined for this resource');
    }
    
    // prepare url with params
    $url = explode('/', $this->functions[$name]['uri']);
    foreach($url as &$urlitem)
    {
      if (substr($urlitem,0,1)==':') {
        $key = substr($urlitem,1);
        if (isset($params[$key])) {
          $urlitem = $params[$key];
          unset($params[$key]);
        }
      }
    }
    $req_url = implode('/', $url);
    $response = $this->app->getClient()->getRequest()->signedRequest($this->app->getBaseURI(). $req_url, $this->functions[$name]['method'], $params);
    if ($response->code==200) {
      $this->data = $response->body;
    } else {
      throw new \AddressixAPI\Exception('Request to resource failed: ' . $response->code . '. URI was: ' . $this->app->getBaseURI(). $req_url);
    }
  }
  
  public function data()
  {
    return $this->data;
  }
  
  // Standard REST functions
  public function setId($id)
  {
    $this->id = $id;
  }

  public function get($id,array $params = array())
  {
    if (!isset($this->loaded)) {
      $this->id = $id;
      $params['id'] = $id;
      $this->request('get',$params);
      $this->loaded = true;
    }
    return $this->data;
  }
  
  public function update()
  {
    $this->request('update',array('id'=>$id));
  }
  
  public function insert()
  {
    $this->request('insert',array('id'=>$id));
    $this->id = $this->loadId();
  }
  
  public function delete()
  {
    $this->request('delete',array('id'=>$id));
  }
  
  public function getId()
  {
    return $this->id;
  }
  
  public function loadId()
  {
    return $this->data->id;
  }
}