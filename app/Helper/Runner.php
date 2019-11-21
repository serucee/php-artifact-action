<?php


namespace ArtifactCreation\Helper;


use ArtifactCreation\Model\ConfigurationAbstract;

/**
 * Main runner for commands passed by configuration objects
 *
 * Class Runner
 * @package ArtifactCreation\Helper
 */
class Runner
{
    /**
     * Execute a command using the passed configuration
     *
     * @param ConfigurationAbstract $configuration
     */
    public function execute(ConfigurationAbstract $configuration)
    {
        $fullCommand = sprintf(
            'cd %s && %s',
            $configuration->getExecutionPath(),
            $configuration->getCommand()
        );

        shell_exec($fullCommand);
    }
}