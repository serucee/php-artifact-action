<?php namespace ArtifactActionTest;

use ArtifactCreation\Model\PackageConfigurationZip;

class PackageConfigurationZipTest extends \Codeception\Test\Unit
{
    /** @var string $executionPath */
    protected $executionPath;
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
        //$this->command = 'composer install --no-dev --ignore-platform-reqs --no-interaction';
        //$this->executionPath = '/github/workspace';
    }

    // tests

    public function testPackageConfiguration()
    {
        $packageConfiguration = $this->getMinPackageConfiguration();
        $packageConfiguration->setCommand();

        $this->assertFalse($packageConfiguration->hasBlackList());
        $this->assertEquals($this->baseCmd, $packageConfiguration->getCommand());
    }

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

    public function testExecutionPath()
    {
        $packageConfiguration = $this->getMinPackageConfiguration();
        $this->assertEquals($this->executionPath, $packageConfiguration->getExecutionPath());
    }

    protected function getMinPackageConfiguration()
    {
        $configurationArray = ['type' => 'zip'];
        return new PackageConfigurationZip($configurationArray);
    }
}
