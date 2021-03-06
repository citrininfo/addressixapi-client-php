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
    $this->functions['get_menu'] = 
      array(
        'method' => 'GET',
        'uri' => '/:siteid/menus/:id'
      );
  }

  public function getMenu($siteid, $menuid)
  {
    $this->request('get_menu', array('siteid'=>$siteid, 'id'=>$menuid));
    return $this->data;
  }

}