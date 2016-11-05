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

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class PropertyPathMatcher implements PropertyPathMatcherInterface
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * Constructor.
     *
     * @param PropertyAccessorInterface $propertyAccessor The property accessor
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * {@inheritdoc}
     */
    public function matchRouteParameters(array $parameters, $objectOrArray)
    {
        foreach ($parameters as $key => $params) {
            if (0 === strpos($params, '{{')) {
                $path = trim(trim(trim($params, '{{'), '}}'));
                $parameters[$key] = $this->propertyAccessor->getValue($objectOrArray, $path);
            }
        }

        return $parameters;
    }
}
