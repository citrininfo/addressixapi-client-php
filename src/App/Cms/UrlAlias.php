<?php
namespace AddressixAPI\App\Cms;

use AddressixAPI\App\Resource;

class Article extends Resource
{
  protected $resource_uri = '/cms';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/articles/:id/:langcode'
      );
    $this->functions['get_processed'] = 
      array(
        'method' => 'GET',
        'uri' => '/urlaliases/process'
      );
  }

  public function getProcessed($siteid, $langcode, $alias)
  {
    $this->request('get_processed', array('siteid'=>$siteid, 'language'=>$langcode, 'alias'=>$alias));
    return $this->data;
  }

}