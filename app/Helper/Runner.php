<?php


namespace ArtifactCreation\Helper;


use ArtifactCreation\Model\ConfigurationAbstract;

class Runner
{
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