<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Roles extends Enum
{
    const FARMER = "FARMER";
    const PROCESSOR = "PROCESSOR";
    const STORAGE =  "STORAGE";
    const ADMIN =  "ADMIN";
    const SUPER_ADMIN =  "SUPER_ADMIN";
}
