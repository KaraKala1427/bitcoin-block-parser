<?php

declare(strict_types=1);

namespace Output;

use Exception;
use Network\NetworkInterface;

/**
 * Interface OutputInterface
 */
interface OutputInterface
{
    /**
     * @return string
     */
    public function script(): string;

    /**
     * @return string
     */
    public function hex(): string;

    /**
     * @return string
     */
    public function hash(): string;

    /**
     * @return string
     */
    public function witnessHash(): string;

    /**
     * @return string
     */
    public function asm(): string;

    /**
     * @param NetworkInterface|null $network
     * @return string
     */
    public function address(NetworkInterface $network = null): string;

    /**
     * @param string $script
     * @throws Exception
     * @return void
     */
    static public function validateScript(string $script);

    /**
     * @param string $script
     * @return OutputInterface
     */
    static public function fromScript(string $script): OutputInterface;

    /**
     * @param string $hex
     * @return OutputInterface
     */
    static public function fromHex(string $hex): OutputInterface;
}