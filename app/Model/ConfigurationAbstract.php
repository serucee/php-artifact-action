<?php


namespace ArtifactCreation\Model;


use ArtifactCreation\Helper\ArrayHelper;

abstract class ConfigurationAbstract
{
    const KEY_EXECUTION_PATH = 'execution_path';

    protected $configurationArray;
    protected $executionPath;
    protected $command;

    public function __construct($configuration)
    {
        $this->configurationArray = $configuration;
        $this->setExecutionPath();
        $this->setCommand();
    }

    protected function setExecutionPath() {
        $executionPath = ArrayHelper::valueByKey($this->configurationArray, self::KEY_EXECUTION_PATH);
        if ($executionPath === null) {
            $executionPath = '/github/workspace';
        }

        $this->executionPath = $executionPath;
    }

    protected function setCommand() {
        $this->command = 'echo "No command defined!"';
    }

    public function getCommand() {
        return $this->command;
    }

    public function getExecutionPath() {
        return $this->executionPath;
    }
}