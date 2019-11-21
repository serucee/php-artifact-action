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
    const KEY_EXECUTION_PATH = 'execution_path';

    /** @var array $configurationArray */
    protected $configurationArray;
    /** @var string $executionPath */
    protected $executionPath;
    /** @var string $command */
    protected $command;

    /**
     * ConfigurationAbstract constructor.
     *
     * @param $configuration
     *
     * @throws MissingParameterException
     */
    public function __construct($configuration)
    {
        $this->configurationArray = $configuration;
        $this->setExecutionPath();
        $this->setCommand();
    }

    /**
     * Set the execution path for the command
     *
     * @throws MissingParameterException
     */
    protected function setExecutionPath() {
        $executionPath = ArrayHelper::valueByKey($this->configurationArray, self::KEY_EXECUTION_PATH);
        if ($executionPath === null) {
            $executionPath = '/github/workspace';
        }

        $this->executionPath = $executionPath;
    }

    /**
     * Set command
     */
    protected function setCommand() {
        $this->command = 'echo "No command defined!"';
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand() {
        return $this->command;
    }

    /**
     * Get execution path
     *
     * @return string
     */
    public function getExecutionPath() {
        return $this->executionPath;
    }
}