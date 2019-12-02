<?php namespace ArtifactActionTest;

use ArtifactCreation\Builder\PackageConfigurationBuilder;
use ArtifactCreation\Model\PackageConfigurationZip;

/**
 * Class PackageConfigurationBuilderTest
 *
 * @group model
 * @package ArtifactActionTest
 *
 * @since 0.0.1
 */
class PackageConfigurationBuilderTest extends \Codeception\Test\Unit
{
    /** @var PackageConfigurationBuilder $packageConfigurationBuilder */
    protected $packageConfigurationBuilder;

    /**
     * Setup Package Configuration Builder
     *
     * @since 0.0.1
     */
    protected function _before()
    {
        $this->packageConfigurationBuilder = new PackageConfigurationBuilder();
    }

    // tests

    /**
     * Test if Package Configuration Zip was created
     *
     * @small
     *
     * @since 0.0.1
     */
    public function testBuildZipPackageConfiguration()
    {
        $packageConfiguration = $this->packageConfigurationBuilder->build(['type' => 'zip']);
        $this->assertInstanceOf(PackageConfigurationZip::class, $packageConfiguration);
    }
}