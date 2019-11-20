<?php


namespace ArtifactCreation\Helper;


use Exception;

abstract class ExecutionAbstract
{
    const KEY_EXECUTION_PATH = 'execution_path';

    protected $configuration;
    protected $executionPath;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @throws Exception
     */
    protected function setExecutionPath()
    {
        if (!isset($this->configuration[self::KEY_EXECUTION_PATH])) {
            throw new Exception('Execution path not set in configuration file!');
        }
        $this->executionPath = $this->configuration[self::KEY_EXECUTION_PATH];
    }

    /**
     * @param $context
     * @param Exception $error
     */
    protected function dieWithError($context, $error) {
        $msg = sprintf(
            'Could not execute %s:: %s',
        $context,
        $error->getMessage()
        );
        echo $msg;
        die();
    }
}