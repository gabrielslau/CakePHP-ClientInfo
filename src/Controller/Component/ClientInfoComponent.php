<?php

namespace CakephpClientInfo\Controller\Component;

use Cake\Controller\Component;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

/**
 * Collects info about the client device used to access the app
 *
 * @package CakephpMixpanel\Controller\Component
 */
class ClientInfoComponent extends Component
{
    /**
     * @var \Sinergi\BrowserDetector\Browser
     */
    public $Browser;

    /**
     * @var \Sinergi\BrowserDetector\Os
     */
    public $Os;

    /**
     * @var \Sinergi\BrowserDetector\Language
     */
    public $Language;

    /**
     * @var \Sinergi\BrowserDetector\Device
     */
    public $Device;

    /**
     * @param array $config Array of config.
     *
     * @throws \Sinergi\BrowserDetector\InvalidArgumentException
     */
    public function initialize(array $config = [])
    {
        parent::initialize($config);

        $userAgent = $this->request()->env('HTTP_USER_AGENT');
        $acceptLanguage = $this->request()->env('HTTP_ACCEPT_LANGUAGE');

        $this->Browser = new Browser($userAgent);
        $this->Os = new Os($userAgent);
        $this->Device = new Device($userAgent);
        $this->Language = new Language($acceptLanguage);
    }

    public function request()
    {
        return $this->_registry->getController()->request;
    }

    public function browser()
    {
        return $this->Browser->getName();
    }

    public function browserVersion()
    {
        return $this->Browser->getVersion();
    }

    public function device()
    {
        $device = 'Computer';
        if ($this->request()->is('mobile')) {
            $device = 'Mobile';
        } elseif ($this->request()->is('tablet')) {
            $device = 'Tablet';
        }

        $deviceName = $this->Device->getName();

        if ($deviceName !== Device::UNKNOWN) {
            $device .= "[$deviceName]";
        }

        return $device;
    }

    public function os()
    {
        return $this->Os->getName();
    }

    public function language()
    {
        return $this->Language->getLanguage();
    }
}
