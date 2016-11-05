<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Component\RoutingExtra\Routing;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class RouterExtra implements RouterExtraInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PropertyPathMatcherInterface
     */
    private $matcher;

    /**
     * Constructor.
     *
     * @param RouterInterface              $router              The rooter
     * @param PropertyPathMatcherInterface $propertyPathMatcher The property path matcher
     */
    public function __construct(RouterInterface $router, PropertyPathMatcherInterface $propertyPathMatcher)
    {
        $this->router = $router;
        $this->matcher = $propertyPathMatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, array $parameters, $data, $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        if (null !== $data) {
            $parameters = $this->matcher->matchRouteParameters($parameters, $data);
        }

        return $this->router->generate($name, $parameters, $referenceType);
    }
}
