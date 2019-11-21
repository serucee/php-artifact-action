<?php

namespace ArtifactCreation\Builder;

use ArtifactCreation\Exception\MissingConfigurationException;
use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;
use ArtifactCreation\Helper\ConfigurationParser;
use ArtifactCreation\Model\PackageZipConfiguration;

class PackageConfigurationBuilder
{
    /**
     * Builds the package configuration
     *
     * @param $packageConfiguration
     *
     * @return PackageZipConfiguration
     *
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     */
    public function build($packageConfiguration) {
        $packageType = ArrayHelper::valueByKey($packageConfiguration, ConfigurationParser::CONFIGURATION_KEY_PACKAGE_TYPE);

        if ($packageType === PackageZipConfiguration::PACKAGE_TYPE) {
            return new PackageZipConfiguration($packageConfiguration);
        }

        throw new MissingConfigurationException('No available package type configured!');
    }
}