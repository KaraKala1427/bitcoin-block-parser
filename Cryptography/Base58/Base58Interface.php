<?php
namespace Cryptography\Base58;

interface Base58Interface
{
    /**
     * Encode a string into base58.
     *
     * @param  string $string The string you wish to encode.
     * @return string The Base58 encoded string.
     */
    public function encode($string);

    /**
     * Decode base58 into a PHP string.
     *
     * @param  string $base58 The base58 encoded string.
     * @return string Returns the decoded string.
     */
    public function decode($base58);
}
