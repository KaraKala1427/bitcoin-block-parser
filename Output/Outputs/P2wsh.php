<?php

declare(strict_types=1);

namespace Output\Outputs;

use Exception;
use Network\NetworkInterface;
use Output\AbstractOutput;
use Output\OutputInterface;
use Validate;

/**
 * Class P2wsh
 * Pay-To-WitnessScriptHash output.
 * @package Output\Outputs
 */
class P2wsh extends AbstractOutput
{
    const SCRIPT_LEN = 34;

    /**
     * @var string
     */
    protected $witnessHash;

    /**
     * P2wsh constructor.
     * @param OutputInterface|string $witnessHash
     * @throws \Exception
     */
    public function __construct($witnessHash)
    {
        if ($witnessHash instanceof OutputInterface) {
            $witnessHash = $witnessHash->witnessHash();
        }

        $this->witnessHash = Validate::witnessHash($witnessHash);
    }

    /**
     * @return string
     */
    public function script(): string
    {
        return "\x00\x20" . $this->witnessHash;
    }

    /**
     * @return string
     */
    public function asm(): string
    {
        return sprintf('0 PUSHDATA(32)[%s]', bin2hex($this->witnessHash));
    }

    /**
     * @param NetworkInterface|null $network
     * @return string
     */
    public function address(NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2wsh($this->witnessHash);
    }

    /**
     * @param string $script
     * @throws Exception
     */
    static public function validateScript(string $script)
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2WSH script length.');
        }

        if ("\x00" != $script[0] ||
            "\x20" != $script[1]) {
            throw new Exception('Invalid P2WSH script format.');
        }
    }

    /**
     * @param string $script
     * @return OutputInterface
     * @throws Exception
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $witnessHash = substr($script, 2, 32);

        return new static($witnessHash);
    }
}