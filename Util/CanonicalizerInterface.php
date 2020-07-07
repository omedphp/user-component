<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Omed\Component\User\Util;

interface CanonicalizerInterface
{
    /**
     * Canonicalize the string.
     *
     * @param string $string
     *
     * @return string
     */
    public function canonicalize(string $string): ?string;
}
