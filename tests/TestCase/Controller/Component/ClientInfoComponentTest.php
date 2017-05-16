<?php

namespace CakephpClientInfo\Test\TestCase\Controller\Component;

use CakephpClientInfo\Controller\Component\ClientInfoComponent;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Language;
use Sinergi\BrowserDetector\Os;

/**
 * Class ClientInfoComponentTest
 *
 * @property \Cake\Controller\Controller                                 $Controller
 * @property \CakephpClientInfo\Controller\Component\ClientInfoComponent $ClientInfo
 *
 * @package CakephpClientInfo\Test\TestCase\Controller\Component
 */
class ClientInfoComponentTest extends TestCase
{
    private $Controller;
    private $ClientInfo;
    private $HTTP_USER_AGENT;
    private $HTTP_ACCEPT_LANGUAGE;

    public function setUp()
    {
        parent::setUp();

        Configure::write('App', []);

        $this->Controller = new Controller();
        $this->Controller->loadComponent('CakephpClientInfo.ClientInfo');
        $this->Controller->startupProcess();

        $this->ClientInfo = $this->Controller->ClientInfo;

        $this->HTTP_USER_AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36';
        $this->HTTP_ACCEPT_LANGUAGE = 'en-US,en;q=0.8,pt-BR;q=0.6,pt;q=0.4';
    }

    public function tearDown()
    {
        unset(
            $this->ClientInfo,
            $this->Controller
        );

        parent::tearDown();
    }

    public function testInstances()
    {
        self::assertInstanceOf(ClientInfoComponent::class, $this->ClientInfo);
        self::assertInstanceOf(Browser::class, $this->ClientInfo->Browser);
        self::assertInstanceOf(Os::class, $this->ClientInfo->Os);
        self::assertInstanceOf(Device::class, $this->ClientInfo->Device);
        self::assertInstanceOf(Language::class, $this->ClientInfo->Language);
    }

    public function testComponent()
    {
        $_SERVER['HTTP_USER_AGENT'] = $this->HTTP_USER_AGENT;
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = $this->HTTP_ACCEPT_LANGUAGE;

        self::assertEquals('Chrome', $this->ClientInfo->browser());
        self::assertEquals('57.0.2987.133', $this->ClientInfo->browserVersion());
        self::assertEquals('Linux', $this->ClientInfo->os());
        self::assertEquals('Computer', $this->ClientInfo->device());
    }

    public function testInstanceMethods()
    {
        $_SERVER['HTTP_USER_AGENT'] = $this->HTTP_USER_AGENT;
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = $this->HTTP_ACCEPT_LANGUAGE;

        self::assertEquals('Chrome', $this->ClientInfo->Browser->getName());
        self::assertEquals('57.0.2987.133', $this->ClientInfo->Browser->getVersion());
        self::assertEquals('Linux', $this->ClientInfo->Os->getName());
        self::assertEquals('unknown', $this->ClientInfo->Device->getName());
    }
}
