CakePHP ClientInfo Plugin
=======================

This plugin provides easy access to information about the client app requesting your site. It is just a wrapper and uses the [Browser Detector library](https://github.com/sinergi/browser-detector) to collect the data.

Requirements
------------

- PHP >= 5.6
- CakePHP >= 3.0


How to Install
----------

```
composer require okatsuralau/cakephp-clientinfo@1.0.0
```

How to Use
----------

Load the plugin in your `config/bootstrap.php` file:
```
Plugin::load('CakephpClientInfo');
```

Load the component in your `src/Controller/AppController.php`

```php
public function initialize()
{
    parent::initialize();

    $this->loadComponent('CakephpClientInfo.ClientInfo');
}
```

To get the info about the client use the

```php
public function index()
{
    // returns the browser name (eg.: Chrome)
    $this->ClientInfo->browser();
    
    // returns the O.S. name (eg.: Linux)
    $this->ClientInfo->os();
    
    // returns the Device name (eg.: Computer, Mobile, Tablet, iPhone, ...)
    $this->ClientInfo->device();
    
    // returns the browser's language (eg.: en)
    $this->ClientInfo->language();
    
    // or you can access the original instance and make calls directly to the browser-detector
    $this->ClientInfo->Browser()->getName();
}
```

More information about the [Browser Detector library](https://github.com/sinergi/browser-detector).

License
-------

Copyright 2017 Gabriel Lau

Available for you to use under the MIT license. See: http://www.opensource.org/licenses/MIT
