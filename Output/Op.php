<?php

declare(strict_types=1);

namespace Output;

/**
 * Interface Op
 */
interface Op
{
    const DUP = "\x76";
    const EQUAL = "\x87";
    const EQUALVERIFY = "\x88";
    const HASH160 = "\xa9";
    const CHECKSIG = "\xac";
    const CHECKMULTISIG = "\xae";
}