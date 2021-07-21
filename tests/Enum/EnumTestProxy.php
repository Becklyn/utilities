<?php

namespace Becklyn\Utilities\Tests\Enum;

use Becklyn\Utilities\Enum\Enum;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2020-07-01
 *
 * @method static $this testKonst1()
 * @method static $this testKonst2()
 */
class EnumTestProxy extends Enum
{
    const TEST_KONST_1 = 'TEST_KONST_1';
    const TEST_KONST_2 = 'TEST_KONST_2';
}
