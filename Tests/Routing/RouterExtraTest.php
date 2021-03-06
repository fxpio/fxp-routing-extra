<?php

/*
 * This file is part of the Fxp package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RoutingExtra\Tests\Routing;

use Fxp\Component\RoutingExtra\Routing\PropertyPathMatcher;
use Fxp\Component\RoutingExtra\Routing\RouterExtra;
use Fxp\Component\RoutingExtra\Routing\RouterExtraInterface;
use Fxp\Component\RoutingExtra\Tests\Fixtures\Model\Foo;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author François Pluchino <francois.pluchino@gmail.com>
 *
 * @internal
 */
final class RouterExtraTest extends TestCase
{
    /**
     * @var MockObject|RouterInterface
     */
    protected $router;

    /**
     * @var RouterExtraInterface
     */
    protected $routerExtra;

    protected function setUp(): void
    {
        $this->router = $this->getMockBuilder(RouterInterface::class)->getMock();
        $this->routerExtra = new RouterExtra($this->router, new PropertyPathMatcher());
    }

    public function getMatcherConfig()
    {
        $dataArray = [
            'custom_id' => 42,
        ];
        $dataObject = new Foo();
        $dataObject->setBar(42);

        return [
            [$dataArray, ['id' => '{{[custom_id]}}'], ['id' => 42]],
            [$dataArray, ['id' => '{{[custom_id] }}'], ['id' => 42]],
            [$dataArray, ['id' => '{{ [custom_id]}}'], ['id' => 42]],
            [$dataArray, ['id' => '{{ [custom_id] }}'], ['id' => 42]],

            [$dataObject, ['id' => '{{bar}}'], ['id' => 42]],
            [$dataObject, ['id' => '{{bar }}'], ['id' => 42]],
            [$dataObject, ['id' => '{{ bar}}'], ['id' => 42]],
            [$dataObject, ['id' => '{{ bar }}'], ['id' => 42]],
        ];
    }

    /**
     * @dataProvider getMatcherConfig
     *
     * @param array|object $data
     * @param array        $parameters
     * @param array        $validParameters
     */
    public function testGenerate($data, array $parameters, array $validParameters): void
    {
        $this->router->expects($this->once())
            ->method('generate')
            ->with('test', $validParameters)
            ->willReturn('path')
        ;

        $this->assertSame('path', $this->routerExtra->generate('test', $parameters, $data));
    }
}
