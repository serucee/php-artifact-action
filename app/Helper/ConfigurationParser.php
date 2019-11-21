<?php


namespace ArtifactCreation\Helper;


use ArtifactCreation\Builder\PackageConfigurationBuilder;
use ArtifactCreation\Exception\InvalidFileException;
use ArtifactCreation\Exception\MissingConfigurationException;
use ArtifactCreation\Exception\MissingFileException;
use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Model\ComposerConfiguration;
use ArtifactCreation\Model\PackageConfigurationAbstract;

/**
 * Parses the mandatory configuration file
 * and acts as a DTO
 *
 * Class ConfigurationParser
 * @package ArtifactCreation\Helper
 */
class ConfigurationParser
{
    /** @var string CONFIGURATION_KEY_COMPOSER */
    const CONFIGURATION_KEY_COMPOSER = 'composer';
    /** @var string CONFIGURATION_KEY_PACKAGE */
    const CONFIGURATION_KEY_PACKAGE = 'package';
    /** @var string CONFIGURATION_KEY_PACKAGE_TYPE */
    const CONFIGURATION_KEY_PACKAGE_TYPE = 'type';

    /** @var array $configuration */
    protected $configuration;
    /** @var ComposerConfiguration|null $composerConfiguration */
    protected $composerConfiguration;
    /** @var PackageConfigurationAbstract $packageConfiguration */
    protected $packageConfiguration;


    /**
     * ConfigurationParser constructor.
     *
     * @param string $fullyQualifiedFileName
     *
     * @throws InvalidFileException
     * @throws MissingConfigurationException
     * @throws MissingFileException
     * @throws MissingParameterException
     */
    public function __construct($fullyQualifiedFileName)
    {
        $this->configuration = $this->parseJsonFile($fullyQualifiedFileName);
        $this->initPackageConfiguration();
        $this->initComposerConfiguration();
    }


    /**
     * Parse the json file with the given fully qualified filename
     *
     * @param $fullyQualifiedFileName
     *
     * @return mixed
     *
     * @throws InvalidFileException
     * @throws MissingFileException
     */
    protected function parseJsonFile($fullyQualifiedFileName)
    {
        $fileContentRaw = file_get_contents($fullyQualifiedFileName);
        if ($fileContentRaw === false) {
            throw new MissingFileException('Could not load configuration file!');
        }

        $fileContent = json_decode($fileContentRaw, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new InvalidFileException('Configuration file is not valid json!');
        }

        if (!is_array($fileContent)) {
            throw new InvalidFileException('Configuration file could not be parsed as an array');
        }

        return $fileContent;
    }

    /**
     * Fetch the given key from the loaded configuration
     *
     * @param string|int $key
     * @param bool $mandatory Throw error if value does not exist
     *
     * @return array|string|null
     *
     * @throws MissingParameterException
     */
    protected function fetchConfigurationParameter($key, $mandatory = false)
    {
        return ArrayHelper::valueByKey($this->configuration, $key, $mandatory);
    }

    /**
     * Initialize the package configuration
     *
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     */
    protected function initPackageConfiguration()
    {
        $packageConfiguration = $this->fetchConfigurationParameter(self::CONFIGURATION_KEY_PACKAGE, true);
        $this->packageConfiguration = (new PackageConfigurationBuilder())->build($packageConfiguration);
    }

    /**
     * Initialize the composer configuration
     *
     * @throws MissingParameterException
     */
    protected function initComposerConfiguration()
    {
        $composerConfiguration = $this->fetchConfigurationParameter(self::CONFIGURATION_KEY_COMPOSER);

        if ($composerConfiguration !== null) {
            $composerConfiguration = new ComposerConfiguration($composerConfiguration);
        }

        $this->composerConfiguration = $composerConfiguration;
    }

    /**
     * Get the composer configuration
     *
     * @return ComposerConfiguration|null
     */
    public function getComposerConfiguration()
    {
        return $this->composerConfiguration;
    }

    /**
     * Get the package configuration
     *
     * @return PackageConfigurationAbstract
     */
    public function getPackageConfiguration()
    {
        return $this->packageConfiguration;
    }

    /**
     * Check if composer configuration exists
     *
     * @return bool
     */
    public function hasComposerConfiguration()
    {
        if ($this->composerConfiguration === null) {
            return false;
        }

        return true;
    }
}