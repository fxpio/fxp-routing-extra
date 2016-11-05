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

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
interface PropertyPathMatcherInterface
{
    /**
     * Match the route parameters with property path variables with the value in object or array.
     *
     * @param array        $parameters    The route parameters
     * @param object|array $objectOrArray The object or array to traverse
     *
     * @return array The route parameters
     */
    public function matchRouteParameters(array $parameters, $objectOrArray);
}
