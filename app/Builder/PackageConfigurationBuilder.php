<?php

namespace ArtifactCreation\Builder;

use ArtifactCreation\Exception\MissingConfigurationException;
use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;
use ArtifactCreation\Model\Configuration;
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
     * Builds the package configuration
     *
     * @param array $packageConfiguration
     *
     * @return PackageConfigurationZip
     *
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     */
    public function build(array $packageConfiguration)
    {
        $packageType = ArrayHelper::valueByKey(
            $packageConfiguration,
            Configuration::CONFIGURATION_KEY_PACKAGE_TYPE
        );

        if ($packageType === PackageConfigurationZip::PACKAGE_TYPE) {
            return new PackageConfigurationZip($packageConfiguration);
        }

        throw new MissingConfigurationException('No available package type configured!');
    }
}
