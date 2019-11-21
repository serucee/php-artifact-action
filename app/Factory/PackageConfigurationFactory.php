<?php


namespace ArtifactCreation\Factory;


use ArtifactCreation\Helper\ArrayHelper;
use ArtifactCreation\Helper\ConfigurationParser;
use ArtifactCreation\Model\PackageZipConfiguration;
use Exception;

class PackageConfigurationFactory
{
    /**
     * @param $packageConfiguration
     *
     * @return PackageZipConfiguration
     *
     * @throws Exception
     */
    public function build($packageConfiguration) {
        $packageType = ArrayHelper::valueByKey($packageConfiguration, ConfigurationParser::CONFIGURATION_KEY_PACKAGE_TYPE);

        if ($packageType === PackageZipConfiguration::PACKAGE_TYPE) {
            return new PackageZipConfiguration($packageConfiguration);
        }

        throw new Exception('No available package type configured!');
    }
}