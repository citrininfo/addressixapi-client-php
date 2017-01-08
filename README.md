# Addressix API PHP Client #

## Installation ##

You can either use **Composer** or directly use the **git source**.

## Using Composer ###

To install via [composer](https://getcomposer.org) follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```bash
$ composer require addressix/addressixapi-client-php
```
Be sure to include the composer autoload in your project
```php
require_once '/path/to/your-project/vendor/autoload.php';
```

### Using Git ###
```bash
$ git@github.com:addressix/addressixapi-client-php.git
```

## Usage ##

### Initialization ###

```php
$client = new \AddressixAPI\Client(
  array('clientid' => '<CLIENTID>', 
        'secret' => '<SECRET>',
        'redirect_uri' => '<REDIRECT_URI>'
  ));
```  

The Client takes a config array with the following mandatory parameters:
- clientid (String): your apps client id
- secret (String): your apps secret
- redirect_uri (String): the oauth2callback url (which must be registered)

Optional options:
- endpoint (String): Overwrite the default Addressix API endpoint
- verifyssl (boolean): wheter to verify the SSL peer (default true)

Obtain the Apps Client ID and Secret on [Create API Application](https://www.addressix.com/developer/apps/)
