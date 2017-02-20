<?php
namespace AddressixAPI\App\Directory;

class Contact extends \AddressixAPI\App\Resource
{
  protected $resource_uri = '/contacts';
  
  public function __construct($app)
  {
    parent::__construct($app);
    
    $this->functions['get'] = 
      array(
        'method' => 'GET',
        'uri' => '/contacts/:id'
	);
    $this->functions['search'] = 
      array(
	'method' => 'GET',
        'uri' => '/contacts/'
	);
    $this->functions['getMemberships'] = 
      array(
        'method' => 'GET',
        'uri' => '/contacts/:id/memberships'
	);
    $this->functions['update'] = 
      array(
	'method' => 'PUT',
        'uri' => '/contacts/:addressixid'
	);
    $this->functions['addAddress'] = 
      array(
	'method' => 'POST',
        'uri' => '/contacts/:owner/addresses'
	);
    $this->functions['updateAddress'] = 
      array(
	'method' => 'PUT',
        'uri' => '/contacts/:owner/addresses/:addressid'
	);
  }
  
  public function get($id)
  {
    $this->request('get', array('id'=>$id));
    return $this->data;
  }

  public function search($filters)
  {
    $this->request('search', $filters);
    return $this->data;
  }

  public function getMemberships($id, $params=array())
  {
    $params['id'] = $id;
    $this->request('get', $params);
    return $this->data;  
  }

  public function update($contact)
  {
    $this->request('update', $contact);
    return $this->data;
  }

  public function addAddress($owner, $address)
  {
    if (is_object($address)) {
      $address->owner = $owner;
    } else {
      $address['owner'] = $owner;
    }
    $this->request('addAddress', $address);
    return $this->data;
  }

  public function updateAddress($owner, $address)
  {
    if (is_object($address)) {
      $address->owner = $owner;
    } else {
      $address['owner'] = $owner;
    }
    $this->request('updateAddress', $address);
    return $this->data;
  }
}