<?php namespace ArtifactActionTest;

use ArtifactCreation\Model\ComposerConfiguration;

/**
 * Class ComposerConfigurationTest
 *
 * @group model
 * @package ArtifactActionTest
 *
 * @since 0.0.1
 */
class ComposerConfigurationTest extends \Codeception\Test\Unit
{
    /** @var ComposerConfiguration $composerConfiguration */
    protected $composerConfiguration;
    /** @var string $command */
    protected $command;
    /** @var string $executionPath */
    protected $executionPath;

    /**
     * Setup ComposerConfiguration with an empty array
     * Setup expected default values
     *
     * @since 0.0.1
     */
    protected function _before()
    {
        $configurationArray = [];
        $this->composerConfiguration = new ComposerConfiguration($configurationArray);
        $this->command = 'composer install --no-dev --ignore-platform-reqs --no-interaction';
        $this->executionPath = '/github/workspace';
        $this->composerConfiguration->setCommand();
    }

    // tests

    /**
     * Test if command is set correct
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testCommandIsSetCorrectly()
    {
        $this->assertEquals($this->command, $this->composerConfiguration->getCommand());
    }

    /**
     * Test if execution path is set correct if given
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testExecutionPathIsSetCorrectly()
    {
        $testExecutionPath = 'test/execution/path';
        $composerConfiguration = new ComposerConfiguration([
            ComposerConfiguration::KEY_EXECUTION_PATH => $testExecutionPath,
        ]);
        $this->assertEquals($testExecutionPath, $composerConfiguration->getExecutionPath());
    }

    /**
     * Test if fallback execution path is correct if no execution path is passed
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testFallbackExecutionPathIsSetCorrectly()
    {
        $this->assertEquals($this->executionPath, $this->composerConfiguration->getExecutionPath());
    }
}