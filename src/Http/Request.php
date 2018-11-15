<?php
/** 
 * Class for HTTP Request
 * Class for capsulating the curl request to Addressix
 */
namespace AddressixAPI\Http;

use AddressixAPI\Exception\Exception AS APIException;
use AddressixAPI\Exception\AuthException;

class Request
{
	private $endpoint;	
	private $cookies = array();
  private $client;

	function __construct($client)
	{
		$this->verify = $client->getConfig('verifyssl');
		$this->endpoint = $client->getConfig('endpoint');
    $this->client = $client;
	}

	public function signedRequest($url, $http_method = 'GET', $parameters = array(), array $http_headers = array(), $form_content_type = 1)
  {   
    if ($auth = $this->client->getAuth()) {
      $atok = $auth->getAuthHeader();
      if ($atok) {
	$http_headers['Authorization'] = $atok;
      } else {
	throw(new AuthException('No access token set'));	
      }
    }
    return $this->request($url, $http_method, $parameters, $http_headers, $form_content_type);
  }

  public function getFormattedHeaders($headers)
  {
    $formattedHeaders = array();

    $combinedHeaders = array_change_key_case((array) $headers);

    foreach ($combinedHeaders as $key => $val) {
      $key = trim(strtolower($key));
      $fmh = $key . ': ' . $val;

      $formattedHeaders[] = $fmh;
    }

    if (!array_key_exists('user-agent', $combinedHeaders)) {
      $formattedHeaders[] = 'user-agent: addressixapi-client-php/1.0';
    }

    if (!array_key_exists('expect', $combinedHeaders)) {
      $formattedHeaders[] = 'expect:';
    }

    return $formattedHeaders;
  }
	
	public function request($url, $http_method = 'GET', $parameters = array(), array $http_headers = null, $form_content_type = 1)
	{
		$curl = curl_init();
    $this->client->logger->info("AddressixAPI: $http_method - $url");
    if (!isset($http_headers['Accept'])) {
     $http_headers['Accept'] = 'application/json';
    }
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if (!$this->verify) {
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
		curl_setopt($curl, CURLOPT_HEADER, true);
		$http_headers['Accept'] = 'application/json';

		switch($http_method) {
		case 'GET':
			if (is_array($parameters) && count($parameters) > 0) {
        $url .= '?' . http_build_query($parameters, null, '&');
			} elseif ($parameters) {
				$url .= '?' . $parameters;
			}
			$parameters = array();
			break;
		case 'PUT':
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			break;
                case 'PATCH':
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
			break;
		case 'POST':
			curl_setopt($curl, CURLOPT_POST, true);
			break;
		}
		if (count($parameters)) {
		  // we still have parameters to handle
		  if ($form_content_type==1) {
		    if (is_object($parameters)) {
		      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($parameters));
		      $http_headers['Content-Type'] = 'application/json';
		    }
		    else {
		      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
		    }
		  }
		  else if ($form_content_type==3) {
		    // raw
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters['data']);
		  }
		}
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getFormattedHeaders($http_headers));
		curl_setopt($curl, CURLOPT_URL, $url);
		if( ! $response = curl_exec($curl))
		{
		  if ($response===FALSE) {
		    $errno = curl_errno($curl);
		    if ($errno==60) {
		      throw new APIException('Error calling Addressix-Server. SSL-Verification failed, try option[verifypeer]=false');
		    } else {
		      throw new APIException('Error calling Addressix-Server: Curl-Error: ' . $errno);
		    }
		  }
		  else {
		    throw new APIException('Addressix-Server result has no content');
		  }
		}

		$error = curl_error($curl);
		$info = curl_getinfo($curl);

		$header_size = $info['header_size'];
		$header      = substr($response, 0, $header_size);
		$body        = substr($response, $header_size);
		$httpCode    = $info['http_code'];

    $this->client->logger->info("AddressixAPI: Response $httpCode");

		$resp = new Response($httpCode, $body, $header, array());
		curl_close($curl);
		return $resp;
	}
} 
