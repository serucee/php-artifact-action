<?php

namespace ArtifactCreation\Builder;

use ArtifactCreation\Exception\MissingConfigurationException;
use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;
use ArtifactCreation\Model\Configuration;
use ArtifactCreation\Model\PackageConfigurationAbstract;
use ArtifactCreation\Model\PackageConfigurationZip;

/**
 * Builder for package configuration objects
 *
 * Class PackageConfigurationBuilder
 * @package ArtifactCreation\Builder
 */
class PackageConfigurationBuilder
{

    /**
     * Build and return the package configuration object
     *
     * @param array $packageConfigurationArray
     * @return PackageConfigurationZip
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     *
     * @since 0.0.1
     */
    public function build(array $packageConfigurationArray)
    {
        $packageType = ArrayHelper::valueByKey(
            $packageConfigurationArray,
            Configuration::CONFIGURATION_KEY_PACKAGE_TYPE
        );

        $packageConfiguration = $this->initializePackageConfiguration($packageConfigurationArray, $packageType);
        $packageConfiguration->setCommand();

        return $packageConfiguration;
    }

    /**
     * Initializes the package configuration object
     *
     * @param array $packageConfiguration
     * @param $packageType
     * @return PackageConfigurationZip
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     *
     * @since 0.0.1
     */
    protected function initializePackageConfiguration(array $packageConfiguration, $packageType)
    {
        if ($packageType === PackageConfigurationZip::PACKAGE_TYPE) {
            return new PackageConfigurationZip($packageConfiguration);
        }

        throw new MissingConfigurationException('No available package type configured!');
    }
}
