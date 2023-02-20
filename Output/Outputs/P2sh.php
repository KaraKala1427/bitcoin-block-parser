<?php

declare(strict_types=1);

namespace Output\Outputs;

use Exception;
use Network\NetworkInterface;
use Output\AbstractOutput;
use Output\Op;
use Output\OutputInterface;
use Validate;

/**
 * Class P2sh
 * Pay-To-ScriptHash output
 * @package Output\Outputs
 */
class P2sh extends AbstractOutput
{
    const SCRIPT_LEN = 23;

    /**
     * @var string
     */
    protected $scriptHash;

    /**
     * P2sh constructor.
     * @param OutputInterface|string $scriptHash
     * @throws \Exception
     */
    public function __construct($scriptHash)
    {
        if ($scriptHash instanceof OutputInterface) {
            $scriptHash = $scriptHash->hash();
        }

        $this->scriptHash = Validate::scriptHash($scriptHash);
    }

    /**
     * @return string
     */
    public function script(): string
    {
        return Op::HASH160 . "\x14" . $this->scriptHash . Op::EQUAL;
    }

    /**
     * @return string
     */
    public function asm(): string
    {
        return sprintf('HASH160 PUSHDATA(20)[%s] EQUAL', bin2hex($this->scriptHash));
    }

    /**
     * @return string
     * @param NetworkInterface|null $network
     * @throws \Exception
     */
    public function address(NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2sh($this->scriptHash);
    }

    /**
     * @param string $script
     * @throws Exception
     */
    static public function validateScript(string $script)
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2SH script length.');
        }

        if (Op::HASH160 != $script[0] ||
            "\x14" != $script[1] ||
            Op::EQUAL != $script[-1]) {
            throw new Exception('Invalid P2SH script format.');
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

        $scriptHash = substr($script, 2, -1);

        return new static($scriptHash);
    }
}