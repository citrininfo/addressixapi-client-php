<?php
namespace AddressixAPI\App\Contact;

class Person extends \AddressixAPI\App\Contact\Contact
{
  protected $resource_uri = '/people';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get_profilepicture'] = 
      array(
        'method' => 'GET',
        'uri' => '/people/:id/image'
      );
  }
  
  public function getMe()
  {
    $this->request('get',array('id'=>'me'));
    return $this->data;
  }
  
  public function getMyProfilePicture()
  {
    $this->request('get_profilepicture',array('id'=>'me'));
    return $this->data;
  }
}