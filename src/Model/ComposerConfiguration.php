<?php

namespace ArtifactCreation\Model;

/**
 * Configuration object used to execute composer commands
 *
 * Class ComposerConfiguration
 * @package ArtifactCreation\Model
 */
class ComposerConfiguration extends ConfigurationAbstract
{
    /**
     * Set the command
     */
    public function setCommand()
    {
        $command = 'composer install --no-dev --ignore-platform-reqs --no-interaction';

        $this->command = $command;
    }
}
