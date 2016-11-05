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
use Sonatra\Component\RoutingExtra\Routing\PropertyPathMatcherInterface;
use Sonatra\Component\RoutingExtra\Tests\Fixtures\Model\Foo;

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class PropertyPathMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PropertyPathMatcherInterface
     */
    protected $matcher;

    protected function setUp()
    {
        $this->matcher = new PropertyPathMatcher();
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
    public function testMatcherParameters($data, array $parameters, array $validParameters)
    {
        $result = $this->matcher->matchRouteParameters($parameters, $data);

        $this->assertEquals($validParameters, $result);
    }
}
