<?php

/*
 * This file is part of the Sonatra package.
 *
 * (c) François Pluchino <francois.pluchino@sonatra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonatra\Component\RoutingExtra\Tests\Fixtures\Model;

/**
 * @author François Pluchino <francois.pluchino@sonatra.com>
 */
class Foo
{
    /**
     * @var int
     */
    private $bar;

    /**
     * @param int $bar
     */
    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    /**
     * @return int
     */
    public function getBar()
    {
        return $this->bar;
    }
}
