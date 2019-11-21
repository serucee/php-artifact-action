<?php


namespace ArtifactCreation\Model;


class ComposerConfiguration extends ConfigurationAbstract
{
    protected function setCommand()
    {
        $command = 'composer install --no-dev --ignore-platform-reqs --no-interaction';

        $this->command = $command;
    }
}