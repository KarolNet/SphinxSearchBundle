<?php

namespace Ekiwok\SphinxBundle\Service;

use Ekiwok\SphinxBundle\Exception\ConnectionException;
use Ekiwok\SphinxBundle\Sphinx\QL\Connection;
use Ekiwok\SphinxBundle\Sphinx\SphinxDataProcessorInterface;

class Sphinx
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var SphinxDataProcessorInterface
     */
    protected $processor;

    /**
     * @var array
     */
    protected $connection;

    /**
     * @param array $config configuration
     */
    public function __construct(array $config, SphinxDataProcessorInterface $processor)
    {
        $this->processor = $processor;
        $this->config =$config['connection'];
    }

    /**
     * @param  string $name
     * @return Connection
     */
    public function getConnection($name = 'default')
    {
        if (!isset($this->config)) {
            throw ConnectionException::missingConnection($name, array_keys($this->config));
        }
        if (!isset($this->connection)) {

            $this->connection = new Connection($this->config, $this->processor);
        }

        return $this->connection;
    }
}
