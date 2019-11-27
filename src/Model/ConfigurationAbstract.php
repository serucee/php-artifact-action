<?php

namespace ArtifactCreation\Model;

use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;

/**
 * Abstract configuration object used by runners
 *
 * Class ConfigurationAbstract
 * @package ArtifactCreation\Model
 */
abstract class ConfigurationAbstract
{
    /** @var string KEY_EXECUTION_PATH */
    const KEY_EXECUTION_PATH = 'execution-path';

    /** @var array $configurationArray */
    protected $configurationArray;
    /** @var string $executionPath */
    protected $executionPath;
    /** @var string $command */
    protected $command;

    /**
     * ConfigurationAbstract constructor.
     *
     * @param array $configuration
     *
     * @throws MissingParameterException
     */
    public function __construct(array $configuration)
    {
        $this->configurationArray = $configuration;
        $this->setExecutionPath();
    }

    /**
     * Set the execution path for the command
     *
     * @throws MissingParameterException
     */
    protected function setExecutionPath()
    {
        $executionPath = ArrayHelper::valueByKey($this->configurationArray, self::KEY_EXECUTION_PATH);
        if ($executionPath === null) {
            //@todo replace with passed ENV github.workspace
            $executionPath = '/github/workspace';
        }

        $this->executionPath = $executionPath;
    }

    /**
     * Set command
     */
    abstract public function setCommand();


    /**
     * Get command
     *
     * @return string
     *
     * @throws MissingParameterException
     */
    public function getCommand()
    {
        if (empty($this->command)) {
            throw new MissingParameterException('No command set!');
        }
        return $this->command;
    }

    /**
     * Get execution path
     *
     * @return string
     */
    public function getExecutionPath()
    {
        return $this->executionPath;
    }
}
