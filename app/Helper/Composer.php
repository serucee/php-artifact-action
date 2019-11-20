<?php


namespace ArtifactCreation\Helper;


use Exception;

class Composer extends ExecutionAbstract implements RunnableInterface
{
    const CMD_COMPOSER_INSTALL = 'composer install --no-dev --ignore-platform-reqs';

    /**
     * Run composer
     */
    public function run()
    {
        try {
            $this->setExecutionPath();
        } catch (Exception $e) {
            $this->dieWithError('Composer', $e);
        }

        $this->composerinstall();
    }

    /**
     * Execute composer install
     */
    protected function composerInstall()
    {
        $fullCommand = sprintf(
            'cd %s && %s',
            $this->executionPath,
            self::CMD_COMPOSER_INSTALL);

        shell_exec($fullCommand);
    }
}