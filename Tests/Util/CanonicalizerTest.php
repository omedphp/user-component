<?php

/*
 * This file is part of the Omed project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Omed\Component\User\Util;

use Omed\Component\Core\Test\TestCase;
use Omed\Component\User\Util\Canonicalizer;

class CanonicalizerTest extends TestCase
{
    public function testCanonicalize()
    {
        $canonicalizer = new Canonicalizer();
        $this->assertNull($canonicalizer->canonicalize(''));
        $this->assertSame('foo', $canonicalizer->canonicalize('FOO'));
    }
}
