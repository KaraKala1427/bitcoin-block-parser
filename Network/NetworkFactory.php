<?php

declare(strict_types=1);

namespace Network;

use Exception;

/**
 * Class NetworkFactory
 * @method static NetworkInterface bitcoin()
 */
class NetworkFactory
{
    /**
     * @var array
     */
    static protected $networks = [
        'bitcoin',
    ];

    /**
     * @var NetworkInterface
     */
    static protected $defaultNetwork;

    /**
     * @param NetworkInterface $network
     */
    static public function setDefaultNetwork(NetworkInterface $network)
    {
        static::$defaultNetwork = $network;
    }

    /**
     * @return NetworkInterface
     */
    static public function getDefaultNetwork(): NetworkInterface
    {
        return static::$defaultNetwork ?: static::bitcoin();
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return NetworkInterface
     * @throws Exception
     */
    public function createNetwork(string $name, array $arguments): NetworkInterface
    {
        if (!in_array($name, static::$networks)) {
            throw new Exception(sprintf('Invalid network name: %s.', $name));
        }

        $class = 'Network\\Networks\\' . ucfirst($name);

        return new $class(...$arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return NetworkInterface
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        return $this->createNetwork($name, $arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return NetworkInterface
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static)->createNetwork($name, $arguments);
    }
}