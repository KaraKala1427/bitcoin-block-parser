<?php

declare(strict_types=1);

namespace Network;

use Output\OutputInterface;

/**
 * Interface NetworkInterface
 * @package Network
 */
interface NetworkInterface
{
    /**
     * @param string $pubKeyHash
     * @return string
     */
    public function getAddressP2pkh(string $pubKeyHash): string;

    /**
     * @param string $scriptHash
     * @return string
     */
    public function getAddressP2sh(string $scriptHash): string;

    /**
     * @param string $pubKeyHash
     * @return string
     */
    public function getAddressP2wpkh(string $pubKeyHash): string;

    /**
     * @param string $witnessHash
     * @return string
     */
    public function getAddressP2wsh(string $witnessHash): string;

    /**
     * @param string $address
     * @return OutputInterface
     */
    public function decodeAddress(string $address): OutputInterface;
}