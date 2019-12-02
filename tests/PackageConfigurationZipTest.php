<?php namespace ArtifactActionTest;

use ArtifactCreation\Model\PackageConfigurationZip;

/**
 * Class PackageConfigurationZipTest
 *
 * @group model
 * @package ArtifactActionTest
 *
 * @since 0.0.1
 */
class PackageConfigurationZipTest extends \Codeception\Test\Unit
{
    /** @var string $executionPath */
    protected $executionPath;
    /** @var string $baseCmd */
    protected $baseCmd;

    /**
     * Setup ComposerConfiguration with an empty array
     * Setup expected default values
     *
     * @since 0.0.1
     */
    protected function _before()
    {
        $this->executionPath = '/github/workspace';
        $this->baseCmd = 'zip -r artifact.zip .';
    }

    // tests

    /**
     * Test min command built
     * Without blacklist
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testPackageConfiguration()
    {
        $packageConfiguration = $this->getMinPackageConfiguration();
        $packageConfiguration->setCommand();

        $this->assertFalse($packageConfiguration->hasBlackList());
        $this->assertEquals($this->baseCmd, $packageConfiguration->getCommand());
    }

    /**
     * Test command built
     * Including blacklist
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testPackageConfigurationWithBlacklist()
    {
        $expectedCmd = $this->baseCmd . ' -x /test *git* hello world';
        $configurationArray = [
            'type' => 'zip',
            'file-blacklist' => ['hello', 'world'],
            'folder-blacklist' =>  ['/test', '*git*']
        ];
        $packageConfiguration = new PackageConfigurationZip($configurationArray);
        $packageConfiguration->setCommand();

        $this->assertTrue($packageConfiguration->hasBlackList());
        $this->assertEquals($expectedCmd, $packageConfiguration->getCommand());
    }

    /**
     * Test if execution path is set correctly
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testExecutionPath()
    {
        $packageConfiguration = $this->getMinPackageConfiguration();
        $this->assertEquals($this->executionPath, $packageConfiguration->getExecutionPath());
    }

    /**
     * Return new min PackageConfigurationZip
     * Without blacklist
     *
     * @since 0.0.1
     *
     * @return PackageConfigurationZip
     */
    protected function getMinPackageConfiguration()
    {
        $configurationArray = ['type' => 'zip'];
        return new PackageConfigurationZip($configurationArray);
    }
}
