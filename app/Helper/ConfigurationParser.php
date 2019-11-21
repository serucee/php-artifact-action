<?php


namespace ArtifactCreation\Helper;


use ArtifactCreation\Factory\PackageConfigurationFactory;
use ArtifactCreation\Model\ComposerConfiguration;
use Exception;

class ConfigurationParser
{
    const CONFIGURATION_KEY_COMPOSER = 'composer';
    const CONFIGURATION_KEY_PACKAGE = 'package';
    const CONFIGURATION_KEY_PACKAGE_TYPE = 'type';

    protected $configuration;
    protected $composerConfiguration;
    protected $packageConfiguration;

    /**
     * ConfigurationParser constructor.
     *
     * @param $fullyQualifiedFileName
     *
     * @throws Exception
     */
    public function __construct($fullyQualifiedFileName)
    {
        $this->configuration = $this->parseJsonFile($fullyQualifiedFileName);
        $this->setPackageConfiguration();
        $this->setComposerConfiguration();
    }

    /**
     * @param $fullyQualifiedFileName
     *
     * @return array
     *
     * @throws Exception
     */
    protected function parseJsonFile($fullyQualifiedFileName)
    {
        $fileContentRaw = file_get_contents($fullyQualifiedFileName);
        if ($fileContentRaw === false) {
            throw new Exception('Could not load configuration file!');
        }

        $fileContent = json_decode($fileContentRaw, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new Exception('Configuration file is not valid json!');
        }

        return $fileContent;
    }

    protected function fetchConfigurationParameter($key)
    {
        return ArrayHelper::valueByKey($this->configuration, $key);
    }

    /**
     * Set package configuration
     *
     * @throws Exception
     */
    protected function setPackageConfiguration()
    {
        $packageConfiguration = $this->fetchConfigurationParameter(self::CONFIGURATION_KEY_PACKAGE);
        if ($packageConfiguration === null) {
            throw new Exception('No package configuration provided at .github/artifact-configuration.json');
        }

        $this->packageConfiguration = (new PackageConfigurationFactory())->build($packageConfiguration);

    }

    protected function setComposerConfiguration()
    {
        $composerConfiguration = $this->fetchConfigurationParameter(self::CONFIGURATION_KEY_COMPOSER);

        if ($composerConfiguration !== null) {
            $composerConfiguration = new ComposerConfiguration($composerConfiguration);
        }

        $this->composerConfiguration = $composerConfiguration;
    }

    public function getComposerConfiguration()
    {
        return $this->composerConfiguration;
    }

    public function getPackageConfiguration()
    {
        return $this->packageConfiguration;
    }

    public function hasComposerConfiguration()
    {
        if ($this->composerConfiguration === null) {
            return false;
        }

        return true;
    }
}