<?php
namespace AddressixAPI\App\Cms;

use AddressixAPI\App\Resource;

class UrlAlias extends Resource
{
  protected $resource_uri = '/cms';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/urlaliases/:id'
      );
    $this->functions['get_processed'] = 
      array(
        'method' => 'GET',
        'uri' => '/urlaliases/process'
      );
    $this->functions['get_alias'] = 
      array(
        'method' => 'GET',
        'uri' => '/urlaliases/process_alias'
      );
  }

  public function getProcessed($siteid, $langcode, $alias)
  {
    $this->request('get_processed', array('site'=>$siteid, 'language'=>$langcode, 'alias'=>$alias));
    return $this->data;
  }

  public function getAlias($siteid, $langcode, $path)
  {
    $this->request('get_alias', array('site'=>$siteid, 'language'=>$langcode, 'path'=>$path));
    return $this->data;
  }

}