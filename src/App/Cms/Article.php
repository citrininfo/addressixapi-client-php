<?php
namespace AddressixAPI\App\Cms;

class Article extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/cms';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get_article'] = 
      array(
        'method' => 'GET',
        'uri' => '/:siteid/articles/:id'
      );
    $this->functions['get_menu'] = 
      array(
        'method' => 'GET',
        'uri' => '/:siteid/menus/:id'
      );
  }

  public function getArticle($siteid, $articleid)
  {
    $this->request('get', array('siteid'=>$siteid, 'id'=>$articleid));
    return $this->data;
  }

  public function getMenu($siteid, $menuid)
  {
    $this->request('get_menu', array('siteid'=>$siteid, 'id'=>$menuid));
    return $this->data;
  }

}