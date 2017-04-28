<?php
namespace AddressixAPI\App\Files;

class Folder extends File
{
  protected $resource_uri = '/';
  
  public function __construct($app)
  {
    parent::__construct($app);
    $this->functions['create'] = 
      array(
        'method' => 'POST',
        'uri' => '/folders/:parentid/files/:filename'
      );
  }
  
  function set($data) {
    if ($data->mime == 'application/vnd.addressix.folder') {
      $this->id = $data->itemid;
      $this->owner = $data->owner;
      $this->mime = $data->mime;
      $this->filename = $data->filename;
    }
  }

  function createFile($filename, $content, $params = array()) {
    if (!isset($this->id)) {
      // no id?
      throw new \AddressixAPI\Exception('No id for parent folder set');
    }
    // create the upload link
    $params['parentid'] = $this->id;
    $params['filename'] = $filename;
    $this->request('create_upload', $params);
    $sessionid = $this->data->sessionid;
    $headers = array();
    if (isset($params['mime'])) {
      $headers['Content-Type'] = $params['mime'];
    }
    $this->request('upload', array('sessionid'=>$sessionid, 'data' => $content), $headers, 3);
    $fileitem = new File($this->app);
    $fileitem->setId($this->data->itemid);
    return $fileitem;
  }

  function createFolder($filename) {
    if (!isset($this->id)) {
      // no id?
      throw new \AddressixAPI\Exception('No id for parent folder set');
    }
    // create the folder link
    $params['parentid'] = $this->id;
    $params['filename'] = $filename;
    $params['mime'] = 'application/vnd.addressix.folder';
    $this->request('create', $params);
    $folder = new Folder($this->app);
    $folder->set($this->data);
    return $folder;
  }

  // get a file by path
  function getByPath($path) {
    $this->request('get_path', array('parent'=>$this->id, 'path' => $path));
    if ($this->data->mime == 'application/vnd.addressix.folder') {
      $folder = new Folder($this->app);
      $folder->set($this->data);
      return $folder;
    }
    else {
      $fileitem = new File($this->app);
      $fileitem->set($this->data);
      return $fileitem;
    }
  }

  function copy($filename, $itemid, array $params = array())
  {
    // create the folder link
    $params['parentid'] = $this->id;
    $params['filename'] = $filename;
    $params['copy'] = $itemid;
    $this->request('create', $params);
    $fileitem = new File($this->app);
    $fileitem->setId($this->data->itemid);
    return $fileitem;  
  }
}