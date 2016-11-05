<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Component\RoutingExtra\Tests\Routing;

use Sonatra\Component\RoutingExtra\Routing\PropertyPathMatcher;
use Sonatra\Component\RoutingExtra\Routing\RouterExtra;
use Sonatra\Component\RoutingExtra\Routing\RouterExtraInterface;
use Sonatra\Component\RoutingExtra\Tests\Fixtures\Model\Foo;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class RouterExtraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RouterInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $router;

    /**
     * @var RouterExtraInterface
     */
    protected $routerExtra;

    protected function setUp()
    {
        $this->router = $this->getMockBuilder(RouterInterface::class)->getMock();
        $this->routerExtra = new RouterExtra($this->router, new PropertyPathMatcher());
    }

    public function getMatcherConfig()
    {
        $dataArray = array(
            'custom_id' => 42,
        );
        $dataObject = new Foo();
        $dataObject->setBar(42);

        return array(
            array($dataArray, array('id' => '{{[custom_id]}}'), array('id' => 42)),
            array($dataArray, array('id' => '{{[custom_id] }}'), array('id' => 42)),
            array($dataArray, array('id' => '{{ [custom_id]}}'), array('id' => 42)),
            array($dataArray, array('id' => '{{ [custom_id] }}'), array('id' => 42)),

            array($dataObject, array('id' => '{{bar}}'), array('id' => 42)),
            array($dataObject, array('id' => '{{bar }}'), array('id' => 42)),
            array($dataObject, array('id' => '{{ bar}}'), array('id' => 42)),
            array($dataObject, array('id' => '{{ bar }}'), array('id' => 42)),
        );
    }

    /**
     * @dataProvider getMatcherConfig
     *
     * @param array|object $data
     * @param array        $parameters
     * @param array        $validParameters
     */
    public function testGenerate($data, array $parameters, array $validParameters)
    {
        $this->router->expects($this->once())
            ->method('generate')
            ->with('test', $validParameters);

        $this->routerExtra->generate('test', $parameters, $data, UrlGeneratorInterface::ABSOLUTE_PATH);
    }
}
