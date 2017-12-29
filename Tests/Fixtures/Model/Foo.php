<?php

/*
 * This file is part of the Fxp package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RoutingExtra\Tests\Fixtures\Model;

/**
 * @author François Pluchino <francois.pluchino@gmail.com>
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
