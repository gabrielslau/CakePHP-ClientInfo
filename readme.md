<p align="center">
    <a href="LICENSE.txt" target="_blank">
        <img alt="Software License" src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square">
    </a>
    <a href="https://app.codeship.com/projects/219946" target="_blank">
        <img alt="Build Status" src="https://img.shields.io/codeship/b2c9f990-1c64-0135-200b-020110d102f0.svg?style=flat-square">
    </a>
    <a href="https://app.codeship.com/projects/219946" target="_blank">
        <img alt="Build Status" src="https://app.codeship.com/projects/b2c9f990-1c64-0135-200b-020110d102f0/status?branch=master">
    </a>
    <a href="https://packagist.org/packages/okatsuralau/cakephp-clientinfo" target="_blank">
        <img alt="Latest Stable Version" src="https://img.shields.io/packagist/v/okatsuralau/cakephp-clientinfo.svg?style=flat-square&label=stable">
    </a>
</p>

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
