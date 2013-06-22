<?php

namespace PhantomJsModule\Service;

use PhantomJsModule\Model\Arguments;

class Client
{

    /**
     * @var string
     */
    protected $bin;

    /**
     * Configuration
     *
     * @var array
     */
    protected $config = array();

    /**
     * Command line options
     *
     * @var array
     */
    protected $options = array();

    public function __construct($bin)
    {
        $this->bin = $bin;
        $this->options = new Arguments;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return Arguments
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        if (!($options instanceof Arguments)) {
            $options = new Arguments($options);
        }

        $this->options = $options;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * @return string
     */
    public function execute(Arguments $arguments = array())
    {
        $args = $this->getOptions()->merge($arguments);

        return shell_exec($this->bin . ' ' . $args->toString());
    }

    /**
     * @param string $script Full path to the script
     * @param string $arguments
     * @return string
     */
    public function executeScript($script, $arguments = null)
    {
        $command = array($this->bin, $script);

        if (null !== $arguments) {
            if ($arguments instanceof Arguments) {
                $command[] = $arguments->toString();
            } elseif (is_array($arguments)) {
                $command[] = join(' ', $arguments);
            } elseif (is_string($arguments)) {
                $command[] = $arguments;
            }
        }

        return shell_exec(join(' ', $command));
    }
}