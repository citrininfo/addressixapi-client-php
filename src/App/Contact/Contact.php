<?php
namespace AddressixAPI\App\Contact;

class Contact extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/contacts';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['get_profilepicture'] = 
      array(
        'method' => 'GET',
        'uri' => '/contacts/:id/image'
      );
  }
  
  public function getProfilePicture()
  {
    $this->requets('get_profilepicture');
  }
  
  public function loadId()
  {
    return $this->data->addressixid;
  }
}